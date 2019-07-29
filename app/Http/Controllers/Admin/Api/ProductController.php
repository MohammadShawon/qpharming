<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        /*
         *  Eager Loading with Prices where Quantity is
         *  greater than zero
         * */
        $products = Product::with(['productprices' => static function($query){
            $query->where('quantity','>',0)->orderBy('created_at','asc')->get();
        }])->get();


        return response()->json($products);
    }
}
