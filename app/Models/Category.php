<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'name', 'slug'
    ];

    public function subcategories() {
        return $this->hasMany(SubCategory::class);
    }
}
