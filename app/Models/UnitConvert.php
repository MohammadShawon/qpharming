<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitConvert extends Model
{
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function unit(){
        return $this->belongsTo(Unit::class, 'base_unit_id', 'id');
    }
    
}
