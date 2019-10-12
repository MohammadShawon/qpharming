<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\FarmerBatch;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Http\Requests\FarmerBatch\FarmerBatchStoreRequest;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\FarmerBatch\FarmerBatchUpdateRequest;
use Illuminate\Support\Facades\DB;

class FarmerBatchController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['farmer'] = Farmer::select('name', 'id')->where('id', $id)->first();
        $data['products'] = DB::table('products')
            ->join('sub_categories','products.subcategory_id','=','sub_categories.id')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->select('products.id','products.product_name')
            ->where('categories.name','=','Chicks')
            ->groupBy('products.id')
            ->get();
//        dd($data['products']);
        return view('admin.farmerbatch.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FarmerBatchStoreRequest $request)
    {


        if (FarmerBatch::where('farmer_id',$request->input('farmer_id'))->active())
        {
            Toastr::error('Farmer has one active Batch!', 'Error');
            return redirect('farmer/'.$request->farmer_id);
        }

            $stock = ProductPrice::where('product_id',$request->input('product_id'))->whereRaw('quantity - sold > 0')->get();

        if (($stock->sum('quantity') - $stock->sum('sold')) < $request->input('chicks_quantity'))
        {
            Toastr::error('Do Not Have Enough Stock!!', 'error');
            return redirect('farmer/'.$request->input('farmer_id'));
        }

            $chicks = ProductPrice::where('product_id',$request->input('product_id'))->whereRaw('quantity - sold > 0')->first();

            if ($chicks === null)
            {
                Toastr::error('Do Not Have Chick Stock!!', 'error');
                return redirect('farmer/'.$request->input('farmer_id'));
            }
//        dd($chicks);


            DB::beginTransaction();

            try{
                /* FarmerBatch Create */
                $farmerBatch = FarmerBatch::create([
                    'farmer_id'        =>      $request->input('farmer_id'),
                    'product_id'       =>       $request->input('product_id'),
                    'batch_name'       =>      $request->input('batch_name'),
                    'batch_number'     =>      $request->input('batch_number'),
                    'chicks_quantity'  =>      $request->input('chicks_quantity'),
                    'status'           =>      $request->input('status'),
                    'user_id'          =>      auth()->user()->id,
                    'created_at'       =>      Carbon::parse($request->input('batch_date'))->format('Y-m-d H:i:s'),
                    'chicks_batch_no'   =>      $chicks->batch_no
                ]);
            }catch (\Exception $e)
            {
//                dd($e);
                DB::rollback();
                Toastr::error('Farmer Batch Error','Error');
                return redirect()->back();
            }

            try
            {
                /*
                 * Product Batch update
                 * */
//                $chicksBatch->sold += $request->input('chicks_quantity');
//                $chicksBatch->save();

                /*
                     *  Process Inventory
                     * */

                $product = ProductPrice::where('product_id',$request->input('product_id'))->where('batch_no',$chicks->batch_no)->first();
//                dd($product);
                if ($request->input('chicks_quantity') > ($product->quantity - $product->sold))
                {
                    $productAllBatch = DB::table('product_prices')->selectRaw('id,product_id,batch_no,quantity,sold,sum(quantity - sold) stock')->whereRaw('quantity - sold > 0')->where('product_id',$product->product_id)->groupBy('batch_no')->orderBy('created_at')->get();
//                    dd($productAllBatch);
                    $updateQuantity = 0;
                    $totalUpdate = 0;
                    foreach ($productAllBatch as $value)
                    {
                        $updateQuantity += $value->stock;
                        if ($updateQuantity <= ($request->input('chicks_quantity') - $totalUpdate))
                        {
                            $singleBatch = ProductPrice::find($value->id);
                            $singleBatch->update(array('sold' => $value->sold + $value->stock));
                            $totalUpdate += $value->stock;

                        }


                    }
//                    dd($totalUpdate);

                    if (($request->input('chicks_quantity') - $totalUpdate) !== 0)
                    {

                        $singleBatch = ProductPrice::where('product_id',$request->input('product_id'))->whereRaw('quantity - sold > 0')->first();
//                        dd($singleBatch);
                        $singleBatch->update(array('sold' => $value->sold + ($request->input('chicks_quantity') - $totalUpdate)));

                    }

                    $inventory = Inventory::create([
                        'product_id'        => $chicks->product_id,
                        'user_id'           => auth()->user()->id,
                        'branch_id'         => auth()->user()->branch_id,
                        'unit_id'           => 1,
                        'in_out_qty'        => - $request->input('chicks_quantity'),
                        'remarks'           => 'Batch-'.$farmerBatch->batch_number,
                        'created_at'        => Carbon::now('+6'),
                        'updated_at'        => Carbon::now('+6'),
                    ]);

                }
                else{
                    $product->sold += $request->input('chicks_quantity');
                    $product->save();

                    $inventory = Inventory::create([
                        'product_id'        => $chicks->product_id,
                        'user_id'           => auth()->user()->id,
                        'branch_id'         => auth()->user()->branch_id,
                        'unit_id'           => 1,
                        'in_out_qty'        => - $request->input('chicks_quantity'),
                        'remarks'           => 'Batch-'.$farmerBatch->batch_number,
                        'created_at'        => Carbon::now('+6'),
                        'updated_at'        => Carbon::now('+6'),
                    ]);
                }



            }catch (\Exception $e)
            {
//                dd($e);
                DB::rollback();
                Toastr::error('Inventory Error','Error');
                return redirect()->back();
            }


            DB::commit();

         /* Check farmerBatch insertion  and Toastr */
         if($farmerBatch && $inventory){
            Toastr::success('Farmer Batch Inserted Successfully', 'Success');
            return redirect('farmer/'.$request->farmer_id);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FarmerBatch  $farmerBatch
     * @return \Illuminate\Http\Response
     */
    public function show(FarmerBatch $farmerBatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FarmerBatch  $farmerBatch
     * @return \Illuminate\Http\Response
     */
    public function edit($farmer_id, $batch_id)
    {

        $data['farmerBatch'] = FarmerBatch::all()->where('id', $batch_id)->first();
        return view('admin.farmerbatch.edit', $data);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FarmerBatch  $farmerBatch
     * @return \Illuminate\Http\Response
     */
    public function update(FarmerBatchUpdateRequest $request, $farmer_id, $batch_id)
    {
        $farmerBatch = FarmerBatch::findOrFail($batch_id);

        $farmerBatchUpdate = $farmerBatch->update([
            'farmer_id'        =>      $request->farmer_id,
            'batch_name'       =>      $request->batch_name,
            'batch_number'     =>      $request->batch_number,
            'chicks_quantity'  =>      $request->chicks_quantity,
            'status'           =>      $request->status,
            'user_id'          =>      Auth::user()->id,
        ]);

        /* Check farmerBatch Update  and Toastr */
        if($farmerBatchUpdate){
            Toastr::success('Farmer Batch Updated Successfully', 'Success');
            return redirect('farmer/'.$request->farmer_id);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FarmerBatch  $farmerBatch
     * @return \Illuminate\Http\Response
     */
    public function destroy($batch_id)
    {
        $farmerBatch = FarmerBatch::findOrFail($batch_id);
        $farmerBatchDelete = $farmerBatch->delete();

        if($farmerBatchDelete){
            Toastr::success('Farmer Batch Deleted Successfully', 'Success');
            return redirect()->back();
        }
        abort(404);
    }
}
