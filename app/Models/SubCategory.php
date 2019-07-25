<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SubCategory extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'name', 'slug', 'category_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
