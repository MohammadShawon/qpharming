<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductPrice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'product_id',
        'branch_id',
        'batch_no',
        'quantity',
        'sold',
        'cost_price',
        'selling_price',
        'mfg_date',
        'exp_date',
        'created_at',
        'updated_at'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
