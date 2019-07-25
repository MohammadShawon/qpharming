<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PurchasePayment extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
