<?php

namespace App\Http\Controllers\Admin;

use App\Models\FarmerBatch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Http\Requests\FarmerBatch\FarmerBatchStoreRequest;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\FarmerBatch\FarmerBatchUpdateRequest;

class FarmerBatchController extends Controller
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
    public function create($id)
    {
        $data['farmer'] = Farmer::select('name', 'id')->where('id', $id)->first();
        //dd($data['farmer']);
        return view('admin.farmerbatch.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FarmerBatchStoreRequest $request)
    {
        /* FarmerBatch Create */
        $farmerBatch = FarmerBatch::create([
            'farmer_id'        =>      $request->farmer_id,
            'batch_name'       =>      $request->batch_name,
            'batch_number'     =>      $request->batch_number,
            'status'           =>      $request->status,
            'user_id'          =>      Auth::user()->id,
        ]);

         /* Check farmerBatch insertion  and Toastr */
         if($farmerBatch){
            Toastr::success('Farmer Batch Inserted Successfully', 'Success');
            return redirect('farmer/'.$request->farmer_id);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FarmerBatch  $farmerBatch
     * @return \Illuminate\Http\Response
     */
    public function show(FarmerBatch $farmerBatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FarmerBatch  $farmerBatch
     * @return \Illuminate\Http\Response
     */
    public function edit($farmer_id, $batch_id)
    {

        $data['farmerBatch'] = FarmerBatch::all()->where('id', $batch_id)->first();
        return view('admin.farmerbatch.edit', $data);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FarmerBatch  $farmerBatch
     * @return \Illuminate\Http\Response
     */
    public function update(FarmerBatchUpdateRequest $request, $farmer_id, $batch_id)
    {
        $farmerBatch = FarmerBatch::findOrFail($batch_id);
        
        $farmerBatchUpdate = $farmerBatch->update([
            'farmer_id'        =>      $request->farmer_id,
            'batch_name'       =>      $request->batch_name,
            'batch_number'     =>      $request->batch_number,
            'status'           =>      $request->status,
            'user_id'          =>      Auth::user()->id,
        ]);

        /* Check farmerBatch Update  and Toastr */
        if($farmerBatchUpdate){
            Toastr::success('Farmer Batch Updated Successfully', 'Success');
            return redirect('farmer/'.$request->farmer_id);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FarmerBatch  $farmerBatch
     * @return \Illuminate\Http\Response
     */
    public function destroy($batch_id)
    {
        $farmerBatch = FarmerBatch::findOrFail($batch_id);
        $farmerBatchDelete = $farmerBatch->delete();

        if($farmerBatchDelete){
            Toastr::success('Farmer Batch Deleted Successfully', 'Success');
            return redirect()->back();
        }
        abort(404);
    }
}
