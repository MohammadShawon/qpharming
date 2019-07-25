<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Branch extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'name', 'slug', 'area_id'
    ];

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function farmers() {
        return $this->hasMany(Farmer::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
    
}
