<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FarmerBatch extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $fillable = ['farmer_id','user_id','batch_name','batch_number','chicks_quantity','status','created_at'];

    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        $active = $query->where('status','active')->first();
        if (!empty($active->status))
        {
            return true;
        }
        return false;
    }


}
