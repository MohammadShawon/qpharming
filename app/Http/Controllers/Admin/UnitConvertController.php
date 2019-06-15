<?php

namespace App\Http\Controllers\Admin;

use App\Models\UnitConvert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitConvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('view_unit-convert')) {
                $unitConverts = UnitConvert::latest()->get();
                return $unitConverts;
                return view('admin.unitconvert.index', compact('uniConverts'));
                
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitConvert  $unitConvert
     * @return \Illuminate\Http\Response
     */
    public function show(UnitConvert $unitConvert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitConvert  $unitConvert
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitConvert $unitConvert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitConvert  $unitConvert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitConvert $unitConvert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitConvert  $unitConvert
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitConvert $unitConvert)
    {
        //
    }
}
