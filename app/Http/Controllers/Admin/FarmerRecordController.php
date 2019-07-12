<?php

namespace App\Http\Controllers\Admin;

use App\Models\FarmerRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FarmerRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        return $request->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dump($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FarmerRecord  $farmerRecord
     * @return \Illuminate\Http\Response
     */
    public function show(FarmerRecord $farmerRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FarmerRecord  $farmerRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(FarmerRecord $farmerRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FarmerRecord  $farmerRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FarmerRecord $farmerRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FarmerRecord  $farmerRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(FarmerRecord $farmerRecord)
    {
        //
    }
}
