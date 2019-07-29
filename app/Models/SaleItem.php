<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SaleItem extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	protected $fillable = [
	    'sale_id',
        'product_id',
        'batch_no',
        'cost_price',
        'selling_price',
        'discount',
        'unit_id',
        'quantity',
        'total_cost',
        'total_selling',
        'created-at',
        'updated_at',
    ];
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }

    // public function unit(){
    //     return $this->belongsTo(Unit::class);
    // }


}
