<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return response()->json(Product::get());
    }
}
