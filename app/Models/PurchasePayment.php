<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PurchasePayment extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	protected $fillable = [
        'purchase_id',
        'payment',
        'status',
        'created_at',
        'updated_at',
    ];


    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
