<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseHead\ExpenseheadStoreRequest;
use App\Http\Requests\Expensehead\ExpenseheadUpdateRequest;
use App\Models\ExpenseHead;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ExpenseheadCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseheads = ExpenseHead::latest()->get();
        return view('admin.expensehead.index', compact('expenseheads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expensehead.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseheadStoreRequest $request)
    {
        $expensehead = ExpenseHead::create([
                    'name' => $request->name
                ]);

        if($expensehead){
            Toastr::success('Expense Head Successfully Added', 'Success');
            return redirect()->route('admin.expensehead.index');
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
        $expensehead = ExpenseHead::find($id);
        return view('admin.expensehead.edit', compact('expensehead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseheadUpdateRequest $request, ExpenseHead $expensehead)
    {
        $expensehead = $expensehead->update([
                    'name' => $request->name
                ]);

        if($expensehead){
            Toastr::success('Expense Head Successfully Update', 'Success');
            return redirect()->route('admin.expensehead.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseHead $expensehead)
    {
        $expensehead->delete();
        Toastr::success('Expense head Successfully Deleted', 'Success');
        return redirect()->route('admin.expensehead.index');
    }
}
