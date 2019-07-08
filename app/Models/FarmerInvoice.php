<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerInvoice extends Model
{
    public function farmerbatch(){
        return $this->belongsTo(FarmerBatch::class, 'batch_number');
    }

    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
