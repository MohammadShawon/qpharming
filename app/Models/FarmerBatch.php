<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerBatch extends Model
{
    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    
}
