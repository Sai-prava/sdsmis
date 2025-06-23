<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GramPanchyat;
use App\Models\Village;
use App\Models\Block;
use App\Models\District;
use App\Models\RespondentMaster;
use App\Models\MonthlyFarmingReport;

class FarmerCardController extends Controller
{
    public function farmerCard(Request $request)
    {
        if ($request->ajax()) {
            $query = RespondentMaster::with(['district', 'block', 'gram_panchyat', 'village']);
    
            if ($request->filled('district_id')) {
                $query->where('district_id', $request->district_id);
            }
    
            if ($request->filled('block_id')) {
                $query->where('block_id', $request->block_id);
            }
    
            if ($request->filled('gram_panchyat_id')) {
                $query->where('gram_panchyat_id', $request->gram_panchyat_id);
            }
    
            if ($request->filled('village_id')) {
                $query->where('village_id', $request->village_id);
            }
    
            return datatables()->eloquent($query)
                ->addIndexColumn()
                ->addColumn('district', fn($row) => $row->district->name ?? '-')
                ->addColumn('block', fn($row) => $row->block->name ?? '-')
                ->addColumn('gram_panchyat', fn($row) => $row->gram_panchyat->name ?? '-')
                ->addColumn('village', fn($row) => $row->village->name ?? '-')
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('project.report.farmer_card_view', $row->id) . '" class="btn btn-sm btn-primary" target="_blank">View</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        // Dropdowns for form filters
        $districts = District::all();
        $blocks = Block::where('district_id', $request->district_id)->get();
        $gramPanchyats = GramPanchyat::where('block_id', $request->block_id)->get();
        $villages = Village::where('gram_panchyat_id', $request->gram_panchyat_id)->get();
    
        return view('project.farmer_card.index', compact('districts', 'blocks', 'gramPanchyats', 'villages'));
    }
    


    public function farmerCardView($id)
    {
        $farmerdetailview = RespondentMaster::find($id);
        $monthly_farming_reports = MonthlyFarmingReport::where('respondent_master_id', $id)
            ->orderBy('date_of_update', 'desc')
            ->get();

        return view('project.farmer_card.view', compact('farmerdetailview', 'monthly_farming_reports'));
    }
    public function reportCard($id)
    {
        $monthly_farming_report = MonthlyFarmingReport::find($id);
        return view('project.farmer_card.reportcardView', compact('monthly_farming_report'));
    }
}
