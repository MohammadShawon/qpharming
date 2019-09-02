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
use \DB;

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
        //dd($data['farmer']);
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

            $chicks = Category::where('name','Chicks')->with('products')->first();
            if ($chicks->products->isEmpty())
            {
                Toastr::error('Please Add Chicks to the Product List!', 'Error');
                return redirect('farmer/'.$request->farmer_id);
            }
            $chicksQuantity = 0;
            $chicksBatch = [];
            foreach ($chicks->products as $product)
            {

                $chicksQuantity = ProductPrice::where('product_id',$product->id)->sum('quantity');
                $chicksBatch = ProductPrice::where('product_id',$product->id)->where('quantity','>',0)->first();

            }
            if ($chicksQuantity === 0)
            {
                Toastr::error('Do Not Have Chick Stock!', 'Error');
                return redirect('farmer/'.$request->farmer_id);
            }

            DB::beginTransaction();

            try{
                /* FarmerBatch Create */
                $farmerBatch = FarmerBatch::create([
                    'farmer_id'        =>      $request->farmer_id,
                    'batch_name'       =>      $request->batch_name,
                    'batch_number'     =>      $request->batch_number,
                    'chicks_quantity'  =>      $request->chicks_quantity,
                    'status'           =>      $request->status,
                    'user_id'          =>      Auth::user()->id,
                    'created_at'       =>      Carbon::parse($request->input('batch_date'))->format('Y-m-d H:i:s'),
                    'chicks_batch_no'   =>      $chicksBatch->batch_no
                ]);
            }catch (\Exception $e)
            {
                dd($e);
                DB::rollback();
                Toastr::error('Farmer Batch Error','Error');
                return redirect()->back();
            }

            try
            {
                /*
                 * Product Batch update
                 * */
                $chicksBatch->sold = $request->chicks_quantity;
                $chicksBatch->save();

                $inventory = Inventory::create([
                    'product_id'        => $chicksBatch->product_id,
                    'user_id'           => auth()->user()->id,
                    'branch_id'         => auth()->user()->branch_id,
                    'unit_id'           => 1,
                    'in_out_qty'        => - $request->chicks_quantity,
                    'created_at'        => Carbon::now('+6'),
                    'updated_at'        => Carbon::now('+6'),
                ]);
            }catch (\Exception $e)
            {
                dd($e);
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
