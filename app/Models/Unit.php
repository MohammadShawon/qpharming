<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function saleitems(){
        return $this->hasMany(SaleItem::class);
    }
}
