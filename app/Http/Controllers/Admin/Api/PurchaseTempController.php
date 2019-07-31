<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\ProductPrice;
use App\Models\PurchasetempItem;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseTempController extends Controller
{
    /**
     * SaleTempController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(PurchasetempItem::where('user_id',auth()->user()->id)->with('product')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*
         * Check the Item added already or not
         * */
        if(PurchasetempItem::where('product_id',$request->input('item_id'))->exists())
        {
            $msg = Toastr::success('Already Added an Item','success');
            return response()->json($msg);
        }

        /*
         * Get Product Price
         * */
        $batch = ProductPrice::where('product_id',$request->input('item_id'))->orderBy('created_at','DESC')->first();
        if (!empty($batch))
        {

            $purchaseTemp = PurchasetempItem::create([
                'user_id'       => auth()->user()->id,
                'product_id'    => $request->input('item_id'),
                'batch_no'      =>  $batch->batch_no,
                'cost_price'    => $batch->cost_price,
                'discount'      => 0,
                'unit_id'       => $request->input('unit_id'),
                'quantity'      => 1,
                'total_cost'    => $batch->cost_price,
                'created_at'    => Carbon::now('+6.30'),
                'updated_at'    => Carbon::now('+6.30'),


            ]);
            return $purchaseTemp;
        }
        return 'Quantity is Empty';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
