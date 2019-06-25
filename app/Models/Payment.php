<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'company_id','farmer_id','purposehead_id','bank_id','payment_amount','payment_type','bank_name','received_by','remarks','payment_date'
    ];
    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    public function purposehead(){
        return $this->belongsTo(PurposeHead::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }
}
