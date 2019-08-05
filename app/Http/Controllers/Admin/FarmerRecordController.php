<?php

namespace App\Http\Controllers\Admin;

use App\Models\FarmerBatch;
use App\Models\FarmerRecord;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DemeterChain\C;
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
        $batch = FarmerBatch::where('farmer_id',$request->input('farmer_id'))->where('status','active')->first();
        $startDate = \Carbon\Carbon::parse($batch->created_at);
        $endDate = \Carbon\Carbon::now();

        $record = FarmerRecord::create([
            'user_id'               => auth()->user()->id,
            'batch_number'          => $batch->batch_number,
            'date'                  => Carbon::parse($request->input('date'))->format('Y-m-d H:i'),
            'age'                   => $startDate->diffInDays($endDate) + 1,
            'child_death'           => $request->input('died'),
            'feed_eaten_kg'         => $request->input('feed'),
            'feed_eaten_sack'       => null,
            'feed_left'             => null,
            'weight'                => $request->input('weight'),
            'symptoms'              => $request->input('symptoms'),
            'remarks'               => $request->input('comment'),
            'created_at'            => Carbon::now('+6'),
            'updated_at'            => Carbon::now('+6'),
        ]);

        if ($record)
        {
            Toastr::success('Farmer Records Success!','Success');
            return response()->json('success');
        }
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
