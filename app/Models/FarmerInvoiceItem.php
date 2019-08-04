<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FarmerInvoiceItem extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $fillable = [
	    'farmerinvoice_id',
        'product_id',
        'unit_id',
        'batch_number',
        'cost_price',
        'selling_price',
        'quantity',
        'total_cost',
        'total_selling',
        'created_at',
        'updated_at',
    ];

    public function farmerinvoice(){
        return $this->belongsTo(FarmerInvoice::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function farmerbatch(){
        return $this->belongsTo(FarmerBatch::class);
    }
}
