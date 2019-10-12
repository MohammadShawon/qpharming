<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Collection extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_id','farmer_id','purposehead_id','bank_id','collection_amount','collection_type','collect_type','bank_name','given_by','remarks','collection_date','reference','status'
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
