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
        /* All Product list */
        if (auth()->user()->can('view_product-price')) {

            $productPrices = ProductPrice::latest()->get();
            return view('admin.productprice.index', compact('productPrices'));
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
        /* Product Create form */
        if (auth()->user()->can('create_product-price')) {
            $data['products'] = Product::get(['id','product_name']);
            return view('admin.productprice.create', $data);
        }
        abort(403);

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
        if (auth()->user()->can('create_product-price')) {

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
        abort(403);

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
        /* Product- price EDIT form */
        if (auth()->user()->can('edit_product-price')) {

            $data['products'] = Product::get(['id','product_name']);
            return view('admin.productprice.edit', $data, compact('productPrice'));
        }
        abort(403);
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
//        dd($productPrice);
        /* Update Product - Price */
        if (auth()->user()->can('delete_product-price')) {

            $updateProductPrice = $productPrice->update([
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
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPrice $productPrice)
    {
        /* Product-Price Delete */
        if (auth()->user()->can('delete_product')) {

            $deleteProductPrice = $productPrice->delete();
            if($deleteProductPrice){
                Toastr::success('Product-Price Deleted Successfully', 'Success');
                return redirect()->route('admin.product-price.index');
            }
        }
        abort(403);
    }
}
