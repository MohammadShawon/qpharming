<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FarmerRecord extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $fillable = [
        'user_id',
        'batch_number',
        'date',
        'age',
        'child_death',
        'feed_eaten_kg',
        'feed_eaten_sack',
        'feed_left',
        'weight',
        'symptoms',
        'remarks',
        'created_at',
        'updated_at'

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function farmerbatch(){
        return $this->belongsTo(FarmerBatch::class, 'batch_number');
    }


}
