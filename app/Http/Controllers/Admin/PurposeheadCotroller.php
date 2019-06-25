<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purposehead\PurposeheadStoreRequest;
use App\Http\Requests\Purposehead\PurposeheadUpdateRequest;
use App\Models\PurposeHead;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PurposeheadCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposeheads = PurposeHead::latest()->get();
        return view('admin.purposehead.index', compact('purposeheads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.purposehead.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurposeheadStoreRequest $request)
    {
        $purposehead = PurposeHead::create([
                    'name' => $request->name
                ]);

        if($purposehead){
            Toastr::success('Purpose Head Successfully Added', 'Success');
            return redirect()->route('admin.purposehead.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purposehead = PurposeHead::find($id);
        return view('admin.purposehead.edit', compact('purposehead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurposeheadUpdateRequest $request, PurposeHead $purposehead)
    {
        $purposehead = $purposehead->update([
                    'name' => $request->name
                ]);

        if($purposehead){
            Toastr::success('Purpose Head Successfully Update', 'Success');
            return redirect()->route('admin.purposehead.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurposeHead $purposehead)
    {
        $purposehead->delete();
        Toastr::success('Purpose head Successfully Deleted', 'Success');
        return redirect()->route('admin.purposehead.index');
    }
}
