<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SalePayment extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
