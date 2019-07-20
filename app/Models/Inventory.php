<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'batch_no',
        'unit_id',
        'in_out_qty',
        'created_at',
        'updated_at',
    ];
}
