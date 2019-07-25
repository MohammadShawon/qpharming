<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SaleItem extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
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
