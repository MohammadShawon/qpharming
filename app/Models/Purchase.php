<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Purchase extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	protected $fillable = [
	    'user_id',
        'company_id',
        'purchase_no',
        'purchase_date',
        'due_date',
        'payment_type',
        'bank',
        'sub_total',
        'discount',
        'grand_total',
        'status',
        'remarks',
        'created_at',
        'updated_at'
    ];

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
