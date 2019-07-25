<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Purchase extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
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
