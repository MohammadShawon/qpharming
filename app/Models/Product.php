<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'subcategory_id','product_name','sku','barcode','base_unit_id','description','size','cost_price','selling_price','quantity'
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    
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
