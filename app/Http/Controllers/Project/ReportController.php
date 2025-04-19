<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\GramPanchyat;
use App\Models\Village;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Block;
use App\Models\District;
use App\Models\RespondentMaster;
use App\Models\FarmingProfile;
use App\Models\TrainingReport;
use App\Models\MonthlyFarmingReport;
use App\Models\UserGramPanchyat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RespondentMasterExport;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function monthlyProgress()
    {

        $executive_ids = User::where('role_id', 3)->where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
        $field_staff_ids = User::whereIn('executive_id', $executive_ids)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();

        return view('project.reports.monthly_progress_report', compact(
            'crpUserIds',
        ));
    }
    public function monthlyTraining()
    {
        $now = Carbon::now();
        $executive_ids = User::where('role_id', 3)->where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
        $field_staff_ids = User::whereIn('executive_id', $executive_ids)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();
        return view('project.reports.monthly_training_report', compact(
            'crpUserIds',
        ));
    }
    public function basicFarmerProfile()
    {

        $executive_ids = User::where('role_id', 3)->where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
        $field_staff_ids = User::whereIn('executive_id', $executive_ids)->get()->pluck('id')->toArray();
        $crpUserIds = User::whereIn('field_staff_id', $field_staff_ids)->get()->pluck('id')->toArray();
        $userGramPanchyatIds = UserGramPanchyat::whereIn('user_id', $crpUserIds)->get()->pluck('gram_panchyat_id')->toArray();
        $gramPanchyats = GramPanchyat::whereIn('id', $userGramPanchyatIds)->get();
        return view('project.reports.report_basic_farmer_profile', compact(
            'gramPanchyats',
            'crpUserIds',
        ));
    }
    public function respondentMaster(Request $request)
    {
        $districts = District::all();
        $blocks = collect();
        $gramPanchyats = collect();
        $villages = collect();

        $query = RespondentMaster::with(['district', 'block', 'gram_panchyat', 'village']);

        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
            $blocks = Block::where('district_id', $request->district_id)->get();
        }

        if ($request->filled('block_id')) {
            $query->where('block_id', $request->block_id);
            $gramPanchyats = GramPanchyat::where('block_id', $request->block_id)->get();
        }

        if ($request->filled('gram_panchyat_id')) {
            $query->where('gram_panchyat_id', $request->gram_panchyat_id);
            $villages = Village::where('gram_panchyat_id', $request->gram_panchyat_id)->get();
        }

        if ($request->filled('village_id')) {
            $query->where('village_id', $request->village_id);
        }

        if ($request->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('district', fn($row) => @$row->district->name)
                ->addColumn('block', fn($row) => @$row->block->name)
                ->addColumn('gram_panchyat', fn($row) => @$row->gram_panchyat->name)
                ->addColumn('village', fn($row) => @$row->village->name)
                ->addColumn('action', function ($row) {
                    $url = route('project.report.respondent_master_view', $row->id);
                    return '<a href="' . $url . '" class="btn btn-sm btn-primary">View</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('project.reports.respondent_master', compact('districts', 'blocks', 'gramPanchyats', 'villages'));
    }

    public function getBlocksByDistrict($district_id)
    {
        $blocks = Block::where('district_id', $district_id)->get();
        return response()->json($blocks);
    }
    public function getGramPanchyatsByBlock($block_id)
    {
        $gramPanchyats = GramPanchyat::where('block_id', $block_id)->get();
        return response()->json($gramPanchyats);
    }

    public function getVillagesByGramPanchyat($gram_panchyat_id)
    {
        $villages = Village::where('gram_panchyat_id', $gram_panchyat_id)->get();
        return response()->json($villages);
    }
    public function export(Request $request)
    {
        $query = RespondentMaster::query();

        if ($request->has('district_id') && $request->district_id != '') {
            $query->where('district_id', $request->district_id);
        }

        if ($request->has('block_id') && $request->block_id != '') {
            $query->where('block_id', $request->block_id);
        }

        if ($request->has('gram_panchyat_id') && $request->gram_panchyat_id != '') {
            $query->where('gram_panchyat_id', $request->gram_panchyat_id);
        }

        if ($request->has('village_id') && $request->village_id != '') {
            $query->where('village_id', $request->village_id);
        }

        $respondent_masters = $query->get();

        return Excel::download(new RespondentMasterExport($respondent_masters), 'respondent_masters.xlsx');
    }

    public function respondentMasterView($id)
    {
        $respondentMasterview = RespondentMaster::find($id);
        return view('project.reports.respondent_master_view', compact('respondentMasterview'));
    }
    public function framingProfile(Request $request)
    {
        if ($request->ajax()) {
            $query = FarmingProfile::with('respondent_master');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('farmer_name', function ($row) {
                    return @$row->respondent_master->name . ' (' . @$row->respondent_master->farmer_id . ')';
                })
                ->editColumn('shg_member', function ($row) {
                    return $row->shg_member ? 'Yes' : 'No';
                })
                ->addColumn('action', function ($row) {
                    $url = route('project.framing.profileView', $row->id);
                    return '<a href="' . $url . '" class="btn btn-sm btn-primary">View</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('project.reports.framing_profile');
    }
    public function framingProfileView($id)
    {
        $farming_profile = FarmingProfile::find($id);
        return view('project.reports.framing_profile_view', compact('farming_profile'));
    }
    public function monthlyReportFarmer(Request $request)
    {
        if ($request->ajax()) {
            $query = MonthlyFarmingReport::with('respondent_master');

            if ($request->filled('month')) {
                $query->whereMonth('date_of_update', $request->month);
            }

            if ($request->filled('year')) {
                $query->whereYear('date_of_update', $request->year);
            }

            return DataTables::of($query)
                ->addIndexColumn() // <-- This line is essential for DT_RowIndex
                ->editColumn('month', function ($row) {
                    return $row->date_of_update ? Carbon::parse($row->date_of_update)->format('F Y') : 'N/A';
                })
                ->editColumn('date_of_update', function ($row) {
                    return $row->date_of_update ? Carbon::parse($row->date_of_update)->format('d M, Y') : '';
                })
                ->addColumn('time_of_update', function ($row) {
                    return $row->date_of_update ? Carbon::parse($row->date_of_update)->format('h:i A') : '';
                })
                ->addColumn('farmer_name', function ($row) {
                    return @$row->respondent_master->name . ' (' . @$row->respondent_master->farmer_id . ')';
                })
                ->addColumn('action', function ($row) {
                    $url = route('project.report.monthly-framing-view', $row->id);
                    return '<a href="' . $url . '" class="btn btn-sm btn-primary">View</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('project.reports.monthly_framing_report');
    }
    public function monthlyReportFarmerView($id)
    {
        $monthly_farming_report = MonthlyFarmingReport::find($id);
        return view('project.reports.monthly_framing_report_view', compact('monthly_farming_report'));
    }
    public function totalTraining()
    {
        return view('project.reports.total_training_report');
    }
    public function totalTrainingView($id)
    {
        $training_report = TrainingReport::find($id);
        return view('project.reports.total_training_report_view', compact('training_report'));
    }
}
