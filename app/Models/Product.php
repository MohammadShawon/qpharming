<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'subcategory_id','product_name','sku','barcode','base_unit_id','description','size','created_at','updated_at'
    ];

    public function unit(){
        return $this->belongsTo(Unit::class,'base_unit_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function saleitems(){
        return $this->hasMany(SaleItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseitems(){
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productprices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function getRouteKeyName():string
    {
        return 'product_name';
    }

//    public function farmerinvoiceitem()
//    {
//        return $this->belongsTo(FarmerInvoiceItem::class,'product_id','id');
//    }


}
