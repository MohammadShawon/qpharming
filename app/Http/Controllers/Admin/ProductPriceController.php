<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use App\Http\Requests\ProductPrice\ProductPriceStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\ProductPrice\ProductPriceUpdateRequest;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productPrices = ProductPrice::latest()->get();
        return view('admin.productprice.index', compact('productPrices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.productprice.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPriceStoreRequest $request)
    {
        /* Insert Product - Price */
        $productPrice = ProductPrice::create([
            'product_id'       =>      $request->product_id,
            'batch_no'         =>      $request->batch,
            'quantity'         =>      $request->quantity,
            'cost_price'       =>      $request->cost,
            'selling_price'    =>      $request->sell,
            'mfg_date'         =>      Carbon::parse($request->mfg_date)->format('Y-m-d H:i'),
            'exp_date'         =>      Carbon::parse($request->exp_date)->format('Y-m-d H:i'),
        ]);
        /* Check Product-Price insertion  and Toastr */
        if($productPrice){
            Toastr::success('Product-Price Inserted Successfully', 'Success');
            return redirect()->route('admin.product-price.index');
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function show(ProductPrice $productPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPrice $productPrice)
    {
        $products = Product::all();
        return view('admin.productprice.edit', compact('productPrice', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPriceUpdateRequest $request, ProductPrice $productPrice)
    {
        /* Update Product - Price */
        $updateProductPrice = productPrice::update([
            'product_id'       =>      $request->product_id,
            'batch_no'         =>      $request->batch,
            'quantity'         =>      $request->quantity,
            'cost_price'       =>      $request->cost,
            'selling_price'    =>      $request->sell,
            'mfg_date'         =>      Carbon::parse($request->mfg_date)->format('Y-m-d H:i'),
            'exp_date'         =>      Carbon::parse($request->exp_date)->format('Y-m-d H:i'),
        ]);
        /* Check Product-Price Update  and Toastr */
        if($updateProductPrice){
            Toastr::success('Product-Price Updated Successfully', 'Success');
            return redirect()->route('admin.product-price.index');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPrice $productPrice)
    {
        $deleteProductPrice = $productPrice->delete();
        if($deleteProductPrice){
            Toastr::success('Product-Price Deleted Successfully', 'Success');
            return redirect()->route('admin.product-price.index');
        }
    }
}
