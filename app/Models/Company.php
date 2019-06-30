<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
   protected $fillable = [
        'name',
        'slug',
        'representative_name',
        'phone1',
        'phone2',
        'email',
        'address',
        'opening_balance',
        'starting_date',
        'ending_date',
    ];

    // protected $casts = [
    //     'starting_date' => 'datetime',
        
    // ];
    
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
