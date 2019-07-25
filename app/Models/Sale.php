<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Sale extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function saleitems(){
        return $this->hasMany(SaleItem::class);
    } 
    
    public function salepayment(){
        return $this->hasOne(SalePayment::class);
    }
}
