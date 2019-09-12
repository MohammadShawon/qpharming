<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Expense extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $fillable = [
        'expensehead_id', 'amount', 'description', 'recipient_name', 'user_id','status','created_at'
    ];
    public function expensehead(){
        return $this->belongsTo(ExpenseHead::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
