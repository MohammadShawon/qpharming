<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\ExpenseStoreRequest;
use App\Http\Requests\Expense\ExpenseUpdateRequest;
use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ExpenseCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('admin.expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* Expense CREATE form */
        $users = User::latest()->get();
        $expenseheads = ExpenseHead::latest()->get();
        $expenses = Expense::latest()->get();
        return view('admin.expense.create', compact('expenses', 'users', 'expenseheads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseStoreRequest $request)
    {
        /* Expense STORE */
        $expense = Expense::create([
            'expensehead_id' => $request->expensehead_id,
            'amount'         => $request->amount,
            'description'    => $request->description,
            'recipient_name' => $request->recipient_name,
            'user_id'        => $request->user_id
        ]);

        if($expense){
            Toastr::success('Expense Successfully Added', 'Success');
            return redirect()->route('admin.expense.index');
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
        /* Expense EDIT form */
        $users = User::latest()->get();
        $expenseheads = ExpenseHead::latest()->get();
        $expense = Expense::find($id);
        return view('admin.expense.edit', compact('expense', 'expenseheads', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseUpdateRequest $request, Expense $expense)
    {
        /* Expense UPDATE */
        $expenseUpdate = $expense->update([
            'expensehead_id' => $request->expensehead_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'recipient_name' => $request->recipient_name,
            'user_id' => $request->user_id
        ]);

        if($expenseUpdate){
            Toastr::success('Expense Successfully Update', 'Success');
            return redirect()->route('admin.expense.index');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        /* Expense Delete */
        $expenseDelete = $expense->delete();
        if($expenseDelete){
            Toastr::success('Expense Successfully Deleted', 'Success');
            return redirect()->route('admin.expense.index');
        }
        abort(404);
    }
}
