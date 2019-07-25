<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FarmerInvoiceItem extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
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
