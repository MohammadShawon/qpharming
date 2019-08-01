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

    public function subcategory() {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class,SubCategory::class,'category_id','subcategory_id','id','id');
    }
}
