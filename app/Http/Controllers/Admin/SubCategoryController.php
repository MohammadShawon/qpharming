<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\SubCategory\SubCategoryStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\SubCategory\SubCategoryUpdateRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('view_sub-category')) {
                
                $subcategories = SubCategory::latest()->get();

                return view('admin.subcategory.index', compact('subcategories'));
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
        if (auth()->user()->can('create_sub-category')) {
                
                $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
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
        if (auth()->user()->can('create_sub-category')) {
                
                /* create sub-category */
        $subcategory = SubCategory::create([
            'name' => $request->subcategory,
            'slug' => str_slug($request->subcategory),
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
        if (auth()->user()->can('edit_sub-category')) {
                
                $categories = Category::all();
                return view('admin.subcategory.edit', compact('subCategory', 'categories'));
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
        if (auth()->user()->can('delete_sub-category')) {
                
                $subCategory->delete();
                Toastr::success('Sub-Category Successfully Deleted', 'Success');
                return redirect()->route('admin.sub-category.index');
            }
        abort(403);
    }
}
