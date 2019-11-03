<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DomPDF;

class DailyReportController extends Controller
{
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
        $report = DomPDF::loadView('admin.reports.daily.sale');
        return $report->stream('sale.pdf');
    }


}
