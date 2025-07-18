<?php

namespace App\Http\Controllers\Crp;

use App\Http\Controllers\Controller;
use App\Models\PG;
use App\Models\PgMonthlyProgressReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PgMonthlyProgressReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pgmonthlyprogress = PgMonthlyProgressReport::all();
        return view('crp.pg_monthly_progress_report.index', compact('pgmonthlyprogress'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pgs = PG::all();
        return view('crp.pg_monthly_progress_report.create', compact('pgs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Calculate total sales manually
        $totalSales = $request->input('input_sale_amount', 0) + $request->input('output_sale_amount', 0);
    
        // Create and assign fields
        $report = new PgMonthlyProgressReport();
        $report->pg_id = $request->pg_id;
        $report->month = $request->month;
        $report->year = $request->year;
        $report->meeting_held = $request->meeting_held;
        $report->member_presence_percent = $request->member_presence_percent;
        $report->input_sale_amount = $request->input_sale_amount;
        $report->output_sale_amount = $request->output_sale_amount;
        $report->loan_taken = $request->loan_taken;
        $report->loan_returned = $request->loan_returned;
        $report->interest_paid = $request->interest_paid;
        $report->total_sales = $totalSales;
        // $report->user_id = Auth::id(); // optional
    
        $report->save();
    
        return redirect()->route('crp.pg_monthly_progress_report.index')
                         ->with('success', 'PG Monthly Progress Report submitted successfully.');
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
