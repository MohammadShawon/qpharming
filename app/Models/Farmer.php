<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $fillable = [
        'branch_id','name','phone1','phone2','email','address','opening_balance','starting_date','ending_date','status'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }
    
    public function farmerinvoices(){
        return $this->hasMany(FarmerInvoice::class);
    }
    
    public function farmerbatches(){
        return $this->hasMany(FarmerBatch::class);
    }
    
    public function farmerrecords(){
        return $this->hasMany(FarmerBatch::class);
    }


}
