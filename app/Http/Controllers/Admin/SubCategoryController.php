<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\SubCategory\SubCategoryStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\SubCategory\SubCategoryUpdateRequest;
use App\DataTables\Subcategory\SubcategoryDatatables;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubcategoryDatatables $dataTable)
    {
       
        
        /* List of Sub-Category */
        if (auth()->user()->can('view_sub-category')) {
           return  $dataTable->render('admin.subcategory.index');
            // $data['subcategories'] = SubCategory::latest()->get(['id','name','created_at']);
            // return view('admin.subcategory.index', $data);
        }
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* Sub-Category Create form */
        if (auth()->user()->can('create_sub-category')) {
                
            $data['categories'] = Category::get(['id','name']);
            return view('admin.subcategory.create', $data);
        }
        abort(403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryStoreRequest $request)
    {
        /* create sub-category */
        if (auth()->user()->can('create_sub-category')) {
                
            $subcategory = SubCategory::create([
                'name'        => $request->subcategory,
                'slug'        => str_slug($request->subcategory),
                'category_id' => $request->category,
            ]);

            /* cheack and showing toastr message */
            if($subcategory){
                Toastr::success('Sub-Category Successfully Added', 'Success');
                return redirect()->route('admin.sub-category.index');
            }
            abort(404);
        }
        abort(403);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        /* Sub-Category Edit form */
        if (auth()->user()->can('edit_sub-category')) {
                
            $data['categories'] = Category::get(['id','name']);
            return view('admin.subcategory.edit', $data, compact('subCategory'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryUpdateRequest $request, SubCategory $subCategory)
    {
        if (auth()->user()->can('edit_sub-category')) {
            
            /* update sub-category */
            $resultSubCategory = $subCategory->update([
                
                'category_id'  =>   $request->category,
                'name'         =>   $request->subcategory,
                'slug'         =>   str_slug($request->subcategory),
            ]);

            /* cheack and showing toastr message */
            if($resultSubCategory){
                Toastr::success('Sub-Category Successfully Updated', 'Success');
                return redirect()->route('admin.sub-category.index');
            }
            abort(404);
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        /* Sub-Category Delete */
        if (auth()->user()->can('delete_sub-category')) {
            
            $subCategoryDelete = $subCategory->delete();
            if($subCategoryDelete){
                Toastr::success('Sub-Category Successfully Deleted', 'Success');
                return redirect()->route('admin.sub-category.index');
            }
            abort(404);
        }
        abort(403);
    }
}
