<?php


namespace App\Repository;


use App\Models\Collection;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class AccountsRepository
{
    /**
     * @var Payment
     */
    private $payment;
    /**
     * @var Expense
     */
    private $expense;
    /**
     * @var Collection
     */
    private $collection;

    /**
     * AccountsRepository constructor.
     * @param Payment $payment
     * @param Expense $expense
     * @param Collection $collection
     */
    public function __construct(Payment $payment, Expense $expense, Collection $collection)
    {

        $this->payment = $payment;
        $this->expense = $expense;
        $this->collection = $collection;
    }

    public function findByDay(string $date)
    {
        $payment = DB::table('payments')
            ->where('status','active')
            ->select('payments.purposehead_id as Heads','payments.company_id as Company','payments.farmer_id','payments.user_id as Employee','payments.payee_type as Category','payments.payment_amount as Amount','payments.payment_type as Type','payments.bank_name','payments.reference','payments.received_by as Recipient','payments.remarks','payments.payment_date as Date',DB::raw("'Payments' as Origin"))
        ->where('payments.payment_date','like', '%'.$date.'%')
        ->where('payments.status','active');

        $expense = DB::table('expenses')
            ->where('status','active')
            ->select('expenses.expensehead_id as Heads',DB::raw("'' as Company"),DB::raw("''"),DB::raw("'' as Employee"),DB::raw("'' as Category"),'expenses.amount as Amount',DB::raw("'' as Type"),DB::raw("''"),DB::raw("''"),'expenses.recipient_name as Recipient','expenses.description as remarks','expenses.created_at as Date',DB::raw("'Expense' as Origin"))
        ->where('expenses.created_at', 'like', '%'.$date.'%')
        ->where('expenses.status','active');

        $collection =DB::table('collections')
            ->where('status','active')
            ->select(DB::raw("'' as Heads"),DB::raw("'' as Company"),'collections.farmer_id',DB::raw("'' as Employee"),'collections.collect_type as Category','collections.collection_amount as Amount','collections.collection_type as Type','collections.bank_name','collections.reference','collections.given_by as Recipient','collections.remarks','collections.collection_date as Date',DB::raw("'Collection' as Origin"))
            ->where('collections.collection_date','like', '%'.$date.'%')
            ->where('collections.status','active')
            ->unionAll($payment)
            ->unionAll($expense)
            ->orderBy('Date','desc');
        return collect($collection->get());
    }

    public function findByMonth(string $fromDate, string $toDate)
    {
        $payment = DB::table('payments')
            ->where('status','active')
            ->select('payments.purposehead_id as Heads','payments.company_id as Company','payments.farmer_id','payments.user_id as Employee','payments.payee_type as Category','payments.payment_amount as Amount','payments.payment_type as Type','payments.bank_name','payments.reference','payments.received_by as Recipient','payments.remarks','payments.payment_date as Date',DB::raw("'Payments' as Origin"))
            ->whereBetween('payments.payment_date',[$fromDate, $toDate])
            ->where('payments.status','active');

        $expense = DB::table('expenses')
            ->where('status','active')
            ->select('expenses.expensehead_id as Heads',DB::raw("'' as Company"),DB::raw("''"),DB::raw("'' as Employee"),DB::raw("'' as Category"),'expenses.amount as Amount',DB::raw("'' as Type"),DB::raw("''"),DB::raw("''"),'expenses.recipient_name as Recipient','expenses.description as remarks','expenses.created_at as Date',DB::raw("'Expense' as Origin"))
            ->whereBetween('expenses.created_at',[$fromDate, $toDate])
            ->where('expenses.status','active');

        $collection =DB::table('collections')
            ->where('status','active')
            ->select(DB::raw("'' as Heads"),DB::raw("'' as Company"),'collections.farmer_id',DB::raw("'' as Employee"),'collections.collect_type as Category','collections.collection_amount as Amount','collections.collection_type as Type','collections.bank_name','collections.reference','collections.given_by as Recipient','collections.remarks','collections.collection_date as Date',DB::raw("'Collection' as Origin"))
            ->whereBetween('collections.collection_date',[$fromDate, $toDate])
            ->where('collections.status','active')
            ->unionAll($payment)
            ->unionAll($expense)
            ->orderBy('Date','desc');
        return collect($collection->get());
    }

}
