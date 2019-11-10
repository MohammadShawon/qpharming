<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Sale extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'customer_id',
        'branch_id',
        'sale_no',
        'sale_date',
        'due_date',
        'payment_type',
        'bank',
        'sub_total',
        'discount',
        'grand_total',
        'status' ,
        'remarks',
        'created_at',
        'updated_at'
    ];

    protected $with = ['saleitems','salepayment'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleitems(){
        return $this->hasMany(SaleItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function salepayment(){
        return $this->hasOne(SalePayment::class);
    }
}
