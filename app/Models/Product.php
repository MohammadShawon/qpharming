<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'subcategory_id','product_name','sku','barcode','base_unit_id','description','size','quantity'
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }
    
    public function saleitems(){
        return $this->belongsTo(SaleItem::class);
    }

    public function purchaseitems(){
        return $this->belongsTo(PurchaseItem::class);
    }
}
