<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Services\MonthlyReportService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DomPDF;
class MonthlyReportController extends Controller
{
    /**
     * @var MonthlyReportService
     */
    private $monthlyReportService;

    /**
     * MonthlyReportController constructor.
     * @param MonthlyReportService $monthlyReportService
     */
    public function __construct(MonthlyReportService $monthlyReportService)
    {

        $this->monthlyReportService = $monthlyReportService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.monthly.index');
    }

    public function show(Request $request)
    {
        // Monthly Sales Report
        if ($request->category === 'sales')
        {
            $data['sales'] = $this->monthlyReportService->findSaleReportByMonth($request->form_date, $request->to_date);
            $data['request_from_date'] = $request->form_date;
            $data['request_to_date'] = $request->to_date;
            $report = DomPDF::loadView('admin.reports.monthly.sale',$data);
            return $report->stream('sale.pdf');
        }
        // Monthly Topsheet
        if ($request->category === 'topsheet')
        {
            $data['sales'] = $this->monthlyReportService->findSaleReportByMonth($request->form_date, $request->to_date);
            $data['purchases'] = $this->monthlyReportService->findPurchaseReportByMonth($request->form_date, $request->to_date);
            $data['accounts'] = $this->monthlyReportService->findAccountReportByMonth($request->form_date, $request->to_date);
            $data['request_from_date'] = $request->form_date;
            $data['request_to_date'] = $request->to_date;
            $report = DomPDF::loadView('admin.reports.monthly.topsheet', $data);
            return $report->stream('topsheet.pdf');
        }
        //Monthly Purchase
        if ($request->category === 'purchase')
        {
            $data['purchases'] = $this->monthlyReportService->findPurchaseReportByMonth($request->form_date, $request->to_date);
            $data['request_from_date'] = $request->form_date;
            $data['request_to_date'] = $request->to_date;
            $report = DomPDF::loadView('admin.reports.monthly.purchase', $data);
            return $report->stream('purchase.pdf');
        }
        // Monthly Accounts
        if ($request->category === 'accounts')
        {
            $data['accounts'] = $this->monthlyReportService->findAccountReportByMonth($request->form_date, $request->to_date);
            $data['request_from_date'] = $request->form_date;
            $data['request_to_date'] = $request->to_date;
            $report = DomPDF::loadView('admin.reports.monthly.accounts', $data);
            return $report->stream('accounts.pdf');
        }
        abort(403);
    }
}
