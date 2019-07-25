<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PurchaseItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
}
