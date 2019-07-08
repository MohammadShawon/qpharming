<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerInvoiceItem extends Model
{
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
