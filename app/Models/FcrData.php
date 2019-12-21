<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FcrData extends Model
{
    protected $guarded = [];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
