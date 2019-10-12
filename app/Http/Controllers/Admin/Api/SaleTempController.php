<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\ProductPrice;
use App\Models\SaleTempItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use \Auth;
use Illuminate\Support\Facades\Session;


class SaleTempController extends Controller
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
        return response()->json(SaleTempItem::where('user_id',Auth::user()->id)->with('product')->get());
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
        if(SaleTempItem::where('product_id','=',$request->input('item_id'))->exists())
        {
            $msg = Toastr::success('Already Added an Item','success');
            return response()->json($msg);
        }
        $batch = ProductPrice::where('product_id',$request->item_id)->whereRaw('quantity - sold > 0')->orderBy('created_at','ASC')->first();

        if (!empty($batch))
        {

            $saletemp = SaleTempItem::create([
                'user_id'       => auth()->user()->id,
                'product_id'    => $request->item_id,
                'batch_no'      =>  $batch->batch_no,
                'cost_price'    => $batch->cost_price,
                'selling_price' => $batch->selling_price,
                'discount'      => 0,
                'unit_id'       => $request->unit_id,
                'quantity'      => 1,
                'total_cost'    => $batch->cost_price,
                'total_selling' => $batch->selling_price,
                'created_at'    => Carbon::now('+6.30'),
                'updated_at'    => Carbon::now('+6.30'),


            ]);
            return $saletemp;
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
        $saleTemp = SaleTempItem::find($id);
        $totalQuantity = ProductPrice::where('product_id',$saleTemp->product_id)->sum('quantity') - ProductPrice::where('product_id',$saleTemp->product_id)->sum('sold');

        if ($request->input('quantity') <= $totalQuantity)
        {

            $saleTemp->selling_price = $request->input('selling_price');
            $saleTemp->discount = $request->input('discount');
            $saleTemp->quantity = $request->input('quantity');
            $saleTemp->total_cost = $saleTemp->cost_price * $request->input('quantity');
            $saleTemp->total_selling = $request->input('selling_price') * $request->input('quantity');
            $saleTemp->save();
            return response()->json($saleTemp);

        }
        SaleTempItem::destroy($id);
        $msg = '';
        return $msg;

//        dd($saleTemp);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SaleTempItem::destroy($id);
    }
}
