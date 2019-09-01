<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductPrice;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use function Stringy\create;

class ProductsImport implements ToModel, WithHeadingRow,WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        dd($row);
        $product =   Product::create([
            'subcategory_id'    => $row['subcategoryid'],
            'product_name'      => $row['productname'],
            'sku'               => $row['sku'],
            'barcode'           => $row['barcode'],
            'base_unit_id'      => $row['baseunit'],
            'description'       => $row['description'],
            'size'              => $row['size'],
            'created_at'        => Carbon::now('+6'),
            'updated_at'        => Carbon::now('+6'),
        ]);

             $productPrice = new ProductPrice([
                'product_id'    => $product->id,
                'branch_id'     =>auth()->user()->branch_id,
                'batch_no'      => date('Y'). '-'.random_int(1,50000),
                'quantity'      => $row['stock'],
                'sold'          => 0,
                'cost_price'    => $row['costprice'],
                'selling_price' => $row['sellingprice'],
                'mfg_date'      => null,
                'exp_date'      => null,
                'created_at'    => Carbon::now('+6'),
                'updated_at'    => Carbon::now('+6'),
            ]);


        return $productPrice;
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 500;
    }
}
