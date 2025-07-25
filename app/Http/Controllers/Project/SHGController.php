<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\District;
use App\Models\GramPanchyat;
use App\Models\SHG;
use App\Models\Village;
use Exception;
use Illuminate\Http\Request;

class SHGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shgs = SHG::all();
        $districts = District::all();
        $blocks = Block::all();
        $panchayats = GramPanchyat::all();
        $villages = Village::all();
        return view('project.shg.index',compact('shgs','districts','blocks','panchayats','villages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'code' => 'required',
                'date_of_formation' => 'required',
            ]);
            SHG::create($request->all());
            toastr()->success('SHG Added Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
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
        $shg = SHG::find($id);
        $shg->update($request->all());
        toastr()->success('SHG Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shg = SHG::find($id);
        $shg->delete();
        toastr()->success('SHG Deleted successfully');
        return redirect()->back();
    }
    public function getBlocks($district_id)
    {
        $blocks = Block::where('district_id', $district_id)->get();
        return response()->json($blocks);
    }
    
    public function getPanchayats($block_id)
    {
        $panchayats = GramPanchyat::where('block_id', $block_id)->get();
        return response()->json($panchayats);
    }
    
    public function getVillages($panchayat_id)
    {
        $villages = Village::where('gram_panchyat_id', $panchayat_id)->get();
        return response()->json($villages);
    }
    
}
