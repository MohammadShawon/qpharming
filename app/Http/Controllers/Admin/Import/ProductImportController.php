<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Requests\Import\ProductImportRequest;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use WebDriver\Exception;

class ProductImportController extends Controller
{
    /**
     * @param ProductImportRequest $request
     * @return void
     */
    public function import(ProductImportRequest $request)
    {
        $tempPath = $request->file('csv')->store('temp');
        $path = storage_path('app').'/'.$tempPath;

        if ($request->has('header'))
        {

            try
            {
                $data = Excel::import(new ProductsImport,$path);
                if ($data)
                {
                    Toastr::success('Import Success','success');
                    return redirect()->route('admin.product.index');
                }
            }catch (\Exception $e)
            {
                Toastr::error('Import Failed!Check the fields.','error');
                return redirect()->route('admin.product.index');
            }


        }
        Toastr::error('Import Failed','error');
        return redirect()->back();
    }
}
