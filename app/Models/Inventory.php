<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Inventory extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'product_id',
        'user_id',
        'branch_id',
//        'batch_no',
        'unit_id',
        'in_out_qty',
        'created_at',
        'updated_at',
    ];
}
