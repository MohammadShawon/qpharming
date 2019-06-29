<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function purchasepayment(){
        return $this->hasOne(PurchasePayment::class);
    }

}
