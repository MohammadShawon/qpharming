<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FarmerInvoice extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $fillable = [
        'farmer_id',
        'user_id',
        'batch_number',
        'date',
        'invoice_number',
        'total_amount',
        'status',
        'remarks',
        'receipt_no',
        'created_at',
        'updated_at'
    ];
	protected $with = ['farmerinvoiceitems'];

    public function farmerbatch(){
        return $this->belongsTo(FarmerBatch::class, 'batch_number');
    }

    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function farmerinvoiceitems()
    {
        return $this->hasMany(FarmerInvoiceItem::class,'farmerinvoice_id','id');
    }
}
