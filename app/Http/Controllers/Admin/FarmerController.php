<?php

namespace App\Http\Controllers\Admin;

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

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* show all the farmers */
        if (auth()->user()->can('view_farmer')) {
            
            $farmers = Farmer::latest()->get();
            return view('admin.farmer.index', compact('farmers'));
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
               
            $branches = Branch::all();
            return view('admin.farmer.create', compact('branches'));
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
                
            /* Insert Farmer */
            $farmer = Farmer::create([
                'branch_id'        =>      $request->branch,
                'name'             =>      $request->name,
                'phone1'           =>      $request->phone1,
                'phone2'           =>      $request->phone2,
                'email'            =>      $request->email,
                'address'          =>      $request->address,
                'opening_balance'  =>      $request->opening_balance,
                'starting_date'    =>      Carbon::parse($request->starting_date)->format('Y-m-d H:i'),
                'ending_date'      =>      Carbon::parse($request->ending_date)->format('Y-m-d H:i'),
                'status'           =>      'inactive',
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
                Toastr::success('Farmer Inserted Successfully', 'Success');
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
        return view('admin.Farmer.view', compact('farmer'));
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
                
                $branches = Branch::all();
                return view('admin.farmer.edit', compact('farmer', 'branches'));
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
               
            /* update Farmer */
            $resultFarmer = $farmer->update([
                'branch_id'        =>      $request->branch,
                'name'             =>      $request->name,
                'phone1'           =>      $request->phone1,
                'phone2'           =>      $request->phone2,
                'email'            =>      $request->email,
                'address'          =>      $request->address,
                'opening_balance'  =>      $request->opening_balance,
                'starting_date'    =>      Carbon::parse($request->starting_date)->format('Y-m-d H:i'),
                'ending_date'      =>      Carbon::parse($request->ending_date)->format('Y-m-d H:i'),
                'status'           =>      $request->status,
            ]);

            $user = User::first();
  
                $details = [
                    'farmer_name' => $request->name
                ];
          
                Notification::send($user, new FarmerCreateNotification($details));
            /* Check famer insertion  and Toastr */
            if($farmer){
                Toastr::success('Farmer Updated Successfully', 'Success');
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
       if (auth()->user()->can('delete_farmer')) {
               
                $farmer->delete();
                Toastr::success('Farmer Deleted Successfully', 'Success');
                return redirect()->route('admin.farmer.index');
           }
       abort(403);
    }
}
