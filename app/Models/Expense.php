<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	protected $fillable = [
        'expensehead_id', 'amount', 'description', 'recipient_name', 'user_id'
    ];
    public function expensehead(){
        return $this->belongsTo(ExpenseHead::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
