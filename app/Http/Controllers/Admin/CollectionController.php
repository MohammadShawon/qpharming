<?php

namespace App\Http\Controllers\Admin;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\PurposeHead;
use App\Models\Farmer;
use App\Models\Company;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Http\Requests\Collection\CollectionStoreRequest;
use App\Http\Requests\Collection\CollectionUpdateRequest;
use App\Models\User;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Collection List */
        $data['collections'] = Collection::where('status','active')->latest()->get();
        $data['pending'] = Collection::where('status','pending')->latest()->get();
        return view('admin.collection.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* Collection CREATE form */
        $data['banks']          = Bank::get(['id','bank_name']);
        $data['purposeheads']   = PurposeHead::get(['id','name']);
        $data['farmers']        = Farmer::get(['id','name']);
        $data['companies']      = Company::get(['id','name']);
        $data['users']          = User::get(['id','name']);

        return view('admin.collection.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionStoreRequest $request)
    {

        /* Insert Collection */
        $collection = Collection::create([
            'bank_id'           =>      $request->input('bank_id'),
            'farmer_id'         =>      $request->input('farmer_id'),
            'collection_amount' =>      $request->input('collection_amount'),
            'collection_type'   =>      $request->input('collection_type'),
            'collect_type'      =>      $request->input('collect_type'),
            'bank_name'         =>      $request->input('bank_name'),
            'given_by'          =>      $request->input('given_by'),
            'reference'         =>      $request->input('reference'),
            'remarks'           =>      $request->input('remarks'),
            'collection_date'   =>      Carbon::parse($request->input('collection_date'))->format('Y-m-d'),
        ]);


        /* Check Collection insertion  and Toastr */
        if($collection){
            Toastr::success('Collection Inserted Successfully', 'Success');
            return redirect()->route('admin.collection.index');
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        /* Details of a Single Collection */
        return view('admin.collection.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        /* Collection Edit form */
        $data['banks']          = Bank::get(['id','bank_name']);
        $data['farmers']        = Farmer::get(['id','name']);

        return view('admin.collection.edit', $data, compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(CollectionUpdateRequest $request, Collection $collection)
    {
        /* Insert Collection */
        $collectionUpdate = $collection->update([
            'bank_id'           =>      $request->input('bank_id'),
            'farmer_id'         =>      $request->input('farmer_id'),
            'collection_amount' =>      $request->input('collection_amount'),
            'collection_type'   =>      $request->input('collection_type'),
            'collect_type'      =>      $request->input('collect_type'),
            'bank_name'         =>      ($request->input('collection_type') === 'cash') ? null : $request->input('bank_name'),
            'given_by'          =>      $request->input('given_by'),
            'reference'         =>      $request->input('reference'),
            'remarks'           =>      $request->input('remarks'),
            'collection_date'   =>      Carbon::parse($request->input('collection_date'))->format('Y-m-d'),
        ]);


        /* Check Collection insertion  and Toastr */
        if($collectionUpdate){
            Toastr::success('Collection Updated Successfully', 'Success');
            return redirect()->route('admin.collection.index');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        /* Collection Delete */
        $collectionDelete = $collection->delete();
        if($collectionDelete){
            Toastr::success('Collection Deleted Successfully', 'Success');
            return redirect()->route('admin.collection.index');
        }
        abort(404);
    }
}
