<?php

namespace App\Http\Controllers\Admin\SaleInvoice;

use App\DataTables\Invoices\SaleDataTable;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\ProductPrice;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SalePayment;
use App\Models\SaleTempItem;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DB;
use PhpSpec\Exception\Exception;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SaleDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(SaleDataTable $dataTable)
    {
        $data['invoices'] = $dataTable->query();
        $data['invoicePayments'] = SalePayment::all();
//        dd($data['invoices']->sum('discount'));
        return $dataTable->render('admin.saleinvoice.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create_sale'))
        {
            $data['customers'] = Customer::pluck('id','name');
            $data['sale'] = Sale::orderBy('id','DESC')->first();
            return view('admin.saleinvoice.create',$data);
        }

        Toastr::error('Do Not Have Permission!','error');
        return redirect()->to('/');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (auth()->user()->can('create_sale'))
        {
            /*
            * Check Customer
            * @return sales
            * */
            if (empty($request->input('customer_id')) && empty($request->input('phone')))
            {

                Toastr::error('Customer or Phone Required','error');
                return redirect()->route('admin.sales.create');
            }
            /*
             * If Phone is Empty and Customer Seleted
             * */
            if (empty($request->input('phone')))
            {
                $saleProducts =SaleTempItem::where('user_id',auth()->user()->id)->get();
                /*
                     * Check the empty product
                     * @return farmer invoice
                     * */
                if ($saleProducts->isEmpty())
                {
                    DB::rollback();
                    Toastr::error('No Product Selected!','error');

                    return redirect()->route('admin.sales.create');
                }

//                Complete the Sale
                $this->completeSale($request,$request->input('customer_id'));
//                    Delete the temporary sale items
                SaleTempItem::where('user_id',auth()->user()->id)->delete();
//                        Pass the success message
                Toastr::success('Sale Invoice Complete','Success');
//                    return invoice create page
                return redirect()->route('admin.sales.create');
            }

            if (empty($request->input('customer_id')))
            {
                /*
                 * Exists Customer Check
                 * @return sales page
                 * */
                if(Customer::where('phone',$request->input('phone'))->first())
                {
                    Toastr::error('Customer Exists!','error');
                    return redirect()->route('admin.sales.create');
                }
                /*
                 * Create the new Customer
                 * */
                $customer = Customer::create([
                    'name'   => $request->input('phone'),
                    'phone' => $request->input('phone'),
                    'address'   => null,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);

                if ($customer)
                {
                    $saleProducts =SaleTempItem::where('user_id',auth()->user()->id)->get();
                    /*
                         * Check the empty product
                         * @return farmer invoice
                         * */
                    if ($saleProducts->isEmpty())
                    {
                        DB::rollback();
                        Toastr::error('No Product Selected!','error');

                        return redirect()->route('admin.sales.create');
                    }
//                    Complete The Sale
                    $this->completeSale($request,$customer->id);
//                    Delete the temporary sale items
                    SaleTempItem::where('user_id',auth()->user()->id)->delete();
//                        Pass the success message
                    Toastr::success('Sale Invoice Complete','Success');
//                    return invoice create page
                    return redirect()->route('admin.sales.create');

                }


            }
        }

        Toastr::error('Do Not Have Permission to Sale','error');
        return redirect()->to('/');
    }

    /**
     * Get Sale No with Prefix 00
     * @return int
     */
    protected function getSaleNo()
    {


        $saleId = Sale::orderBy('id','DESC')->first();
        if ($saleId)
        {
            $id = $saleId->id +1;
            return (int)$id;
        }else{
            return 1;
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
        $data['invoice'] = Sale::with('saleitems')->findOrFail($id);
//        dd($data['invoice']);
        return view('admin.saleinvoice.show',$data);
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

    /*
     * @params request,customer
     * @return sales
     * */
    private function completeSale($request,$customer)
    {
        DB::beginTransaction();
        try
        {

            $saleInvoice = Sale::create([
                'user_id'           => auth()->user()->id,
                'customer_id'       => $customer,
                'branch_id'         => $request->input('branch_id'),
                'sale_no'           => 'SALE - '.sprintf('%1$03d',$this->getSaleNo()),
                'sale_date'         => Carbon::parse($request->input('sale_date'))->format('Y-m-d'),
                'due_date'          => Carbon::parse($request->input('due_date'))->format('Y-m-d'),
                'payment_type'      => $request->input('payment_type'),
                'bank'              => $request->input('bank'),
                'sub_total'         => $request->input('sub_total'),
                'discount'          => $request->input('invoiceDiscount'),
                'grand_total'       => $request->input('grand_total'),
                'status'            => 1,
                'remarks'           => $request->input('remarks'),
                'created_at'        => Carbon::now('+6.00'),
                'updated_at'        => Carbon::now('6.00')
            ]);

        }catch (\Exception $e)
        {

            DB::rollback();
//            dd($e);
            Toastr::error('Error Message -'.$e->getMessage(),'error');
            return redirect()->route('admin.sales.create');
        }

        /*
         * Sale Invoice Payments Process
         * */

        try
        {
            $payment = SalePayment::create([
                'sale_id'       => $saleInvoice->id,
                'payment'       => $request->input('payment'),
                'status'        => ($request->input('payment') < $request->input('grand_total'))? 0 : 1,
                'created_at'    => Carbon::now('+6'),
                'updated_at'    => Carbon::now('+6'),
            ]);
        }catch (\Exception $e)
        {

            DB::rollback();
//            dd($e->getMessage());
            Toastr::error('Invoice Payments Error','error');
            return redirect()->route('admin.sales.create');
        }

        /*
         *  Product Process
         * */
        try
        {
            $saleProducts =SaleTempItem::where('user_id',auth()->user()->id)->get();
            /*
                 * Check the empty product
                 * @return farmer invoice
                 * */
            if ($saleProducts->isEmpty())
            {
                DB::rollback();
                Toastr::error('No Product Selected!','error');

                return redirect()->route('admin.sales.create');
            }

            if (!$saleProducts->isEmpty())
            {

                foreach ($saleProducts as $saleProduct)
                {

                    /*
                     * Each Sale Products creates
                     * */
                    $saleProductsData = SaleItem::create([
                        'sale_id'       => $saleInvoice->id,
                        'product_id'    => $saleProduct->product_id,
                        'batch_no'      => $saleProduct->batch_no,
                        'cost_price'    => $saleProduct->cost_price,
                        'selling_price' => $saleProduct->selling_price,
                        'discount'      => $saleProduct->discount,
                        'unit_id'       => $saleProduct->unit_id,
                        'quantity'      => $saleProduct->quantity,
                        'total_cost'    => $saleProduct->total_cost,
                        'total_selling' => $saleProduct->total_selling,
                        'created_at'    => Carbon::now('+6.00'),
                        'updated_at'    => Carbon::now('6.00'),
                    ]);

                    /*
                     *  Process Inventory
                     * */

                    $product = ProductPrice::where('product_id',$saleProduct->product_id)->where('batch_no',$saleProduct->batch_no)->first();
                    if ($saleProduct->quantity > ($product->quantity - $product->sold))
                    {
                        $productAllBatch = DB::table('product_prices')->selectRaw('id,product_id,batch_no,quantity,sold,sum(quantity - sold) stock')->whereRaw('quantity - sold > 0')->where('product_id',$saleProduct->product_id)->groupBy('batch_no')->orderBy('created_at')->get();
                        $updateQuantity = 0;
                        $totalUpdate = 0;
                        foreach ($productAllBatch as $value)
                        {
                            $updateQuantity += $value->stock;

                            if ($updateQuantity <= ($saleProduct->quantity - $totalUpdate))
                            {
                                $singleBatch = ProductPrice::find($value->id);
                                $singleBatch->update(array('sold' => $value->sold + $value->stock));
                                $totalUpdate += $value->stock;

                            }


                        }

                        if (($saleProduct->quantity - $totalUpdate) !== 0)
                        {
                            $singleBatch = ProductPrice::where('product_id',$saleProduct->product_id)->whereRaw('quantity - sold > 0')->first();
                            $singleBatch->update(array('sold' => $value->sold + ($saleProduct->quantity - $totalUpdate)));

                        }

                        /*
                         * Track Inventory
                         * */

                        $inventory = Inventory::create([
                            'product_id'        => $saleProduct->product_id,
                            'user_id'           => auth()->user()->id,
                            'branch_id'           => auth()->user()->id,
                            'unit_id'           => $saleProduct->unit_id,
                            'in_out_qty'        => -$saleProduct->quantity,
                            'remarks'           => 'Sale-'.$saleInvoice->sale_no,
                            'created_at'        => Carbon::now('+6'),
                            'updated_at'        => Carbon::now('+6'),
                        ]);


                    }
                    else
                    {
                        $product->sold += $saleProduct->quantity;
                        $product->save();

                        $inventory = Inventory::create([
                            'product_id'        => $saleProduct->product_id,
                            'user_id'           => auth()->user()->id,
                            'branch_id'           => auth()->user()->id,
                            'unit_id'           => $saleProduct->unit_id,
                            'in_out_qty'        => -$saleProduct->quantity,
                            'remarks'           => 'Sale-'.$saleInvoice->sale_no,
                            'created_at'        => Carbon::now('+6'),
                            'updated_at'        => Carbon::now('+6'),
                        ]);
                    }

                }
            }
        }catch (\Exception $e)
        {
//            dd($e->getMessage());
            DB::rollback();
            Toastr::error('ProductItem Error','error');
            return redirect()->route('admin.sales.create');

        }
        DB::commit();

    }
}
