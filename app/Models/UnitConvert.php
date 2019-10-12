<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UnitConvert extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function unit(){
        return $this->belongsTo(Unit::class, 'base_unit_id', 'id');
    }
    
}
