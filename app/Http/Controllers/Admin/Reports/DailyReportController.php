<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Models\Sale;
use App\Services\DailyReportService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DomPDF;

class DailyReportController extends Controller
{
    /**
     * @var DailyReportService
     */
    private $dailyReportService;

    /**
     * DailyReportController constructor.
     * @param DailyReportService $dailyReportService
     */
    public function __construct(DailyReportService $dailyReportService)
    {

        $this->dailyReportService = $dailyReportService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.daily.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Daily Sales Report
        if ($request->category === 'sales')
        {
            $data['sales'] = $this->dailyReportService->getSaleByDay($request->date);
            $data['request_date'] = $request->date;
            $report = DomPDF::loadView('admin.reports.daily.sale',$data);
            return $report->stream('sale.pdf');
        }
        // Daily Topsheet
        if ($request->category === 'topsheet')
        {
            $data['sales'] = $this->dailyReportService->getSaleByDay($request->date);
            $data['purchases'] = $this->dailyReportService->getPurchaseByDay($request->date);
            $data['accounts'] = $this->dailyReportService->getAccountsReportByDay($request->date);
            $data['request_date'] = $request->date;
            $report = DomPDF::loadView('admin.reports.daily.topsheet', $data);
            return $report->stream('topsheet.pdf');
        }
        //Daily Purchase
        if ($request->category === 'purchase')
        {
            $data['purchases'] = $this->dailyReportService->getPurchaseByDay($request->date);
            $data['request_date'] = $request->date;
            $report = DomPDF::loadView('admin.reports.daily.purchase', $data);
            return $report->stream('purchase.pdf');
        }
        // Daily Accounts
        if ($request->category === 'accounts')
        {
            $data['accounts'] = $this->dailyReportService->getAccountsReportByDay($request->date);
            $data['request_date'] = $request->date;
            $report = DomPDF::loadView('admin.reports.daily.accounts', $data);
            return $report->stream('accounts.pdf');
        }
        abort(403);

    }


}
