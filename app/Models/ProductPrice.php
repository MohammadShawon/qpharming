<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $fillable = [
        'product_id','batch_no','quantity','cost_price','selling_price','mfg_date','exp_date'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
