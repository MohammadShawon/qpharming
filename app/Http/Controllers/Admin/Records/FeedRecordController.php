<?php

namespace App\Http\Controllers\Admin\Records;

use App\DataTables\Stocks\FeedDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DB;

class FeedRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FeedDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(FeedDataTable $dataTable)
    {
        $data['feeds'] = DB::table('product_prices')
            ->join('products','product_prices.product_id','=','products.id')
            ->join('sub_categories','products.subcategory_id','=','sub_categories.id')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->selectRaw('product_prices.product_id,sum(product_prices.quantity) quantity,sum(product_prices.sold) sold,sum(product_prices.quantity - product_prices.sold) stock')
            ->where('categories.name','=','Feeds')
            ->where('product_prices.branch_id',auth()->user()->branch_id)
            ->groupBy('product_prices.product_id')
            ->get();
        return $dataTable->render('admin.stocks.feed',$data);
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
        //
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
