<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }

    public function saleitems(){
        return $this->hasMany(SaleItem::class);
    } 
    
    public function salepayment(){
        return $this->hasOne(SalePayment::class);
    }
}
