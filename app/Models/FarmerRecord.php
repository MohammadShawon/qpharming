<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FarmerRecord extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function farmerbatch(){
        return $this->belongsTo(FarmerBatch::class, 'batch_number');
    }


}
