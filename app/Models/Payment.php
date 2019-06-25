<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    public function purposeHead(){
        return $this->belongsTo(PurposeHead::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }
}
