<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PurchaseItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'batch_no',
        'cost_price',
        'selling_price',
        'discount',
        'unit_id',
        'quantity',
        'total_cost',
        'created_at',
        'updated_at',
    ];

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
