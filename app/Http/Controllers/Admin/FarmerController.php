<?php

namespace App\Http\Controllers\Admin;

use App\Models\FarmerInvoice;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\DataTables\Farmers\FarmersDatatable;
use App\Models\Farmer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Http\Requests\Farmer\FarmerStoreRequest;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Farmer\FarmerUpdateRequest;

use Notification;
use App\Notifications\FarmerCreateNotification;
use App\Models\FarmerBatch;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FarmersDatatable $dataTable
     * @return void
     */
    public function index(FarmersDatatable $dataTable)
    {
        /* show all the farmers */
        if (auth()->user()->can('view_farmer')) {
            return $dataTable->render('admin.farmer.index');
//            $farmers = Farmer::with('branch')->latest()->get();
//            return view('admin.farmer.index', compact('farmers'));
        }
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       if (auth()->user()->can('create_farmer')) {

            $data['branches'] = Branch::get(['id','name']);
            return view('admin.farmer.create', $data);
        }
       abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FarmerStoreRequest $request)
    {
        if (auth()->user()->can('create_farmer')) {

            // Upload Image to The Public/farmer Folder

            $image = $request->file('image');
            $slug  = str_slug($request->name);

            if(isset($image)){
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                //check farmer directory
                if(!Storage::disk('public')->exists('farmer')){
                    Storage::disk('public')->makeDirectory('farmer');
                }
                //resize image for category and upload
                $farmer = Image::make($image)->resize(720, 550)->stream();
                //now save the image
                Storage::disk('public')->put('farmer/'.$imageName,$farmer);
            }
            else{
                $imageName = 'default.png';
            }

            /* Insert farmer */
            $farmer = Farmer::create([
                'branch_id'        =>      $request->branch,
                'name'             =>      $request->name,
                'phone1'           =>      $request->phone1,
                'phone2'           =>      $request->phone2,
                'address'          =>      $request->address,
                'image'            =>      $imageName,
                'opening_balance'  =>      $request->opening_balance,
                'starting_date'    =>      Carbon::parse($request->starting_date)->format('Y-m-d H:i'),
                'ending_date'      =>      Carbon::parse($request->ending_date)->format('Y-m-d H:i'),
                'status'           =>      'active',
            ]);
            // Notification  to admin
            $details = [
                    'farmer_name' => $request->name,
                    'branch_name' => Branch::find($request->branch)->name,
                    'route'       => 'farmer'
                ];
            User::find(1)->notify(new FarmerCreateNotification($details));
            User::find(2)->notify(new FarmerCreateNotification($details));


            /* Check famer insertion  and Toastr */
            if($farmer){
                Toastr::success('farmer Inserted Successfully', 'Success');
                return redirect()->route('admin.farmer.index');
            }
            abort(404);
        }
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
        /* View a Single Farmer Informations */
        if (auth()->user()->can('view_farmer')) {
            $data['farmerInvoices'] = FarmerInvoice::where('farmer_id',$farmer->id)->with('farmerinvoiceitems')->get();
           $data['feeds'] =  DB::table('farmer_invoice_items')
                        ->join('farmer_invoices', 'farmer_invoice_items.farmerinvoice_id', '=', 'farmer_invoices.id')
                        ->join('products',function ($join){
                            $join->on('farmer_invoice_items.product_id', '=', 'products.id');
                        })
                        ->join('sub_categories', function ($join) {
                            $join->on('products.subcategory_id', '=', 'sub_categories.id');
                        })
                        ->join('categories', function ($join) {
                           $join->on('sub_categories.category_id', '=', 'categories.id');
                        })
                        ->select('farmer_invoice_items.*','categories.name','products.product_name','farmer_invoices.receipt_no','farmer_invoices.remarks','farmer_invoices.date')
                        ->where('farmer_invoices.farmer_id',$farmer->id)
                        ->where('categories.name','Feeds')
                        ->get();

            $data['medicines'] =  DB::table('farmer_invoice_items')
                ->join('farmer_invoices', 'farmer_invoice_items.farmerinvoice_id', '=', 'farmer_invoices.id')
                ->join('products',function ($join){
                    $join->on('farmer_invoice_items.product_id', '=', 'products.id');
                })
                ->join('sub_categories', function ($join) {
                    $join->on('products.subcategory_id', '=', 'sub_categories.id');
                })
                ->join('categories', function ($join) {
                    $join->on('sub_categories.category_id', '=', 'categories.id');
                })
                ->select('farmer_invoice_items.*','categories.name','products.product_name','farmer_invoices.receipt_no','farmer_invoices.remarks','farmer_invoices.date')
                ->where('farmer_invoices.farmer_id',$farmer->id)
                ->where('categories.name','Medicines')
                ->get();
//            dd($data['feeds']);
            $data['payments'] = Payment::where('farmer_id',$farmer->id)->get();
            return view('admin.farmer.view',$data,compact('farmer'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {
        if (auth()->user()->can('edit_farmer')) {

            $data['branches'] = Branch::get(['id','name']);
            return view('admin.farmer.edit', $data, compact('farmer'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(FarmerUpdateRequest $request, Farmer $farmer)
    {
       if (auth()->user()->can('edit_farmer')) {

            /* Update Image */

            $image = $request->file('image');
            $slug  = str_slug($request->name);

            if(isset($image)){
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                //check category directory
                if(!Storage::disk('public')->exists('farmer')){
                    Storage::disk('public')->makeDirectory('farmer');
                }
                //Delete old Image
                if(Storage::disk('public')->exists('farmer/'.$farmer->image)){
                   Storage::disk('public')->delete('farmer/'.$farmer->image);
                }
                //resize image for category and upload
                $farmerImage = Image::make($image)->resize(720, 550)->stream();
                //now save the image
                Storage::disk('public')->put('farmer/'.$imageName,$farmerImage);

            }
            else{
                $imageName = $farmer->image;
            }

            /* update farmer */
            $resultFarmer = $farmer->update([
                'branch_id'        =>      $request->branch,
                'name'             =>      $request->name,
                'phone1'           =>      $request->phone1,
                'phone2'           =>      $request->phone2,
                'image'            =>      $imageName,
                'address'          =>      $request->address,
                'opening_balance'  =>      $request->opening_balance,
                'starting_date'    =>      Carbon::parse($request->starting_date)->format('Y-m-d H:i'),
                'ending_date'      =>      Carbon::parse($request->ending_date)->format('Y-m-d H:i'),
                'status'           =>      $request->status,
            ]);

            // $user = User::first();

            //     $details = [
            //         'farmer_name' => $request->name
            //     ];

            //     Notification::send($user, new FarmerCreateNotification($details));
            /* Check famer insertion  and Toastr */
            if($resultFarmer){
                Toastr::success('farmer Updated Successfully', 'Success');
                return redirect()->route('admin.farmer.index');
            }
            abort(404);
        }
       abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmer $farmer)
    {
        try{
            if (auth()->user()->can('delete_farmer')) {

                $farmer->delete();

                /* Delete Image */
                if(Storage::disk('public')->exists('farmer/'.$farmer->image)){
                    Storage::disk('public')->delete('farmer/'.$farmer->image);
                }

                Toastr::success('farmer Deleted Successfully', 'Success');
                return redirect()->back();
            }
        }catch (\Illuminate\Database\QueryException $e)
        {
            Toastr::success('Can Not be Deleted! This Farmer has Data.');
            return redirect()->back();
        }

       abort(403);
    }
}
