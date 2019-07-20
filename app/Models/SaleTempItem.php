<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SaleTempItem extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'batch_no',
        'cost_price',
        'selling_price',
        'discount',
        'unit_id' ,
        'quantity',
        'total_cost',
        'total_selling',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
