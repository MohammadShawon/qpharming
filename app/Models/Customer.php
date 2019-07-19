<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
