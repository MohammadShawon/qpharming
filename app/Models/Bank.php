<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Bank extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'bank_name', 'account_name', 'account_number', 'opening_balance'
    ];
}
