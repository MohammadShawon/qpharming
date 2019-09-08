<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Company extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
   protected $fillable = [
        'name',
        'slug',
        'representative_name',
        'phone1',
        'phone2',
        'email',
        'address',
        'status',
        'type',
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

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName():string
    {
        return 'slug';
    }
}
