<?php

namespace App\Http\Controllers\Admin\PurchaseInvoice;

use App\DataTables\Invoices\PurchaseDataTable;
use App\Http\Requests\Purchase\PurchaseInvoiceStoreRequest;
use App\Models\Company,App\Models\Purchase;
use App\Models\Inventory;
use App\Models\ProductPrice;
use App\Models\PurchaseItem;
use App\Models\PurchasePayment;
use App\Models\PurchasetempItem;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DB;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PurchaseDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(PurchaseDataTable $dataTable)
    {
        /*
         * First Check the user Permission
         * @return create form
         * */
        if (auth()->user()->can('view_purchase'))
        {
            $data['invoices'] = Purchase::all();
            $data['invoicePayments'] = PurchasePayment::all();
//            dd($data['invoicePayments']);
            return $dataTable->render('admin.purchaseinvocie.index',$data);
        }
        /*
         * If Not Permission Assigned
         * */
        Toastr::error('You Do Not Have Permission!','error');
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * First Check the user Permission
         * @return create form
         * */
        if (auth()->user()->can('create_purchase'))
        {
            $data['companies'] = Company::where('status','active')->pluck('id','name');
            $data['purchase'] = Purchase::orderBy('id','DESC')->first();
            return view('admin.purchaseinvocie.create',$data);
        }
        /*
         * If Not Permission Assigned
         * */
        Toastr::error('You Do Not Have Permission!','error');
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseInvoiceStoreRequest $request)
    {
        if (auth()->user()->can('create_purchase'))
        {
            DB::beginTransaction();

//            dd($request->all());

            /*
             * Purchase Table Data
             * */

            try
            {
                $purchase = Purchase::create([
                    'user_id'           => auth()->user()->id,
                    'company_id'        => $request->input('company_id'),
                    'purchase_no'       => $this->getPurchaseNo(),
                    'purchase_date'     => Carbon::parse($request->input('purchase_date')),
                    'due_date'          => null,
                    'payment_type'      => $request->input('payment_type'),
                    'bank'              => $request->input('bank'),
                    'sub_total'         => $request->input('sub_total'),
                    'discount'          => $request->input('invoiceDiscount'),
                    'grand_total'       => $request->input('grand_total'),
                    'status'            => 1,
                    'remarks'           => $request->input('remarks'),
                    'created_at'        => Carbon::now('+6'),
                    'updated_at'        => Carbon::now('+6'),
                ]);
            } catch (\Exception $e)
            {
                DB::rollback();
                Toastr::error('Purchase Error!','error');
                return redirect()->route('admin.purchases.create');
            }

            /*
             *  Purchase Items & Inventory Process
             * */

            try
            {
                $purchaseProducts = PurchasetempItem::where('user_id',auth()->user()->id)->get();
                /*
                         * Check the empty product
                         * @return farmer invoice
                         * */
                if ($purchaseProducts->isEmpty())
                {
                    DB::rollback();
                    Toastr::error('No Product Selected!','error');
                    return redirect()->route('admin.purchases.create');
                }
                if (!$purchaseProducts->isEmpty())
                {
                    foreach ($purchaseProducts as $purchaseProduct)
                    {
                        /*
                         * Each Purchase Product Stored
                         * */
                        $purchaseProductsData = PurchaseItem::create([
                            'purchase_id'   => $purchase->id,
                            'product_id'    => $purchaseProduct->product_id,
                            'batch_no'      => $purchaseProduct->batch_no,
                            'cost_price'    => $purchaseProduct->cost_price,
                            'discount'      => $purchaseProduct->discount,
                            'unit_id'       => $purchaseProduct->unit_id,
                            'quantity'      => $purchaseProduct->quantity,
                            'total_cost'    => $purchaseProduct->cost_price * $purchaseProduct->quantity,
                            'created_at'    => Carbon::now('+6'),
                            'updated_at'    => Carbon::now('+6'),
                        ]);

                        /*
                         * Create Batch
                         * */
                        $batch = ProductPrice::create([
                            'product_id'        => $purchaseProduct->product_id,
                            'branch_id'         => auth()->user()->branch_id,
                            'batch_no'          => date('Y'). '-'.random_int(1,50000),
                            'quantity'          => $purchaseProduct->quantity,
                            'sold'              => 0,
                            'cost_price'        => $purchaseProduct->cost_price,
                            'selling_price'     => ProductPrice::where('product_id',$purchaseProduct->product_id)->orderBy('created_at','desc')->first()->selling_price,
                            'mfg_date'          => Carbon::now('+6'),
                            'exp_date'          => Carbon::now('+6'),
                        ]);

                        /*
                         * Process Inventory
                         * */
                        $inventory = Inventory::create([
                            'product_id'    => $purchaseProduct->product_id,
                            'branch_id'     => auth()->user()->id,
                            'user_id'       => auth()->user()->id,
                            'unit_id'       => $purchaseProduct->unit_id,
                            'in_out_qty'    => +$purchaseProduct->quantity,
                            'remarks'       => 'Purchase-'.$purchase->purchase_no,
                            'created_at'    => Carbon::now('+6'),
                            'updated_at'    => Carbon::now('+6'),
                        ]);

                    }
                }
            }catch (\Exception $e)
            {
//                dd($e);
                DB::rollback();
                Toastr::error('Purchase Item Error!','Error');
                return redirect()->route('admin.purchases.create');
            }

            /*
             * Purchase Invocie Payments
             * */

            try
            {
                $payments = PurchasePayment::create([
                    'purchase_id'   => $purchase->id,
                    'payment'       => $request->input('payment'),
                    'status'        => $request->input('payment') >= $request->input('grand_total')? 1 : 0,
                    'created_at'    => Carbon::now('+6'),
                    'updated_at'    => Carbon::now('+6'),
                ]);
            }catch (\Exception $e)
            {
                DB::rollback();

                Toastr::error('Payments Error!','Error');
                return redirect()->route('admin.purchases.create');
            }

            DB::commit();

            PurchasetempItem::where('user_id',auth()->user()->id)->delete();
            Toastr::success('Purchase Done!','Success');
            return redirect()->route('admin.purchases.index');

        }
    }

    /*
     * Get Purchase Invoice Number with prefix 00
     * @return string
     * */

    protected function getPurchaseNo()
    {
        $purchaseId = Purchase::orderBy('id','desc')->first();
        if ($purchaseId)
        {
            $id = $purchaseId->id +1;
            return sprintf('%1$03d',$id);
        }
        return sprintf('%1$03d',1);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['invoice'] = Purchase::with(['purchaseitems','purchasepayment'])->findOrFail($id);
//        dd($data['invoice']);
        return view('admin.purchaseinvocie.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
