<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductPrice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'product_id','batch_no','quantity','cost_price','selling_price','mfg_date','exp_date'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
