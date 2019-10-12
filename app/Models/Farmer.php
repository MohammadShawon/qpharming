<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Farmer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'branch_id','name','phone1','phone2','email','image','address','opening_balance','starting_date','ending_date','status'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function farmerinvoice(){
        return $this->hasMany(FarmerInvoice::class);
    }

    public function farmerbatches(){
        return $this->hasMany(FarmerBatch::class);
    }

    public function farmerrecords(){
        return $this->hasMany(FarmerBatch::class,'farmer_id','id');
    }


}
