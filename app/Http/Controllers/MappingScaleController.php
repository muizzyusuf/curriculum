<?php

namespace App\Http\Controllers;

use App\Models\MappingScale;
use Illuminate\Http\Request;

class MappingScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
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
        //
        $this->validate($request, [
            
            'title'=> 'required',
            'abbreviation'=> 'required',
            'description'=> 'required',
            'colour'=> 'required',

            ]);

        $ms = new MappingScale;
        $ms->title = $request->input('title');
        $ms->abbreviation = $request->input('abbreviation');
        $ms->description = $request->input('description');
        $ms->colour = $request->input('colour');
        $ms->program_id = $request->input('program_id');
        $ms->save();
        
        if($ms->save()){
            $request->session()->flash('success', 'Mapping scale level added');
        }else{
            $request->session()->flash('error', 'There was an error adding the mapping scale level');
        }
        
        return redirect()->route('programWizard.step3', $request->input('program_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MappingScale  $mappingScale
     * @return \Illuminate\Http\Response
     */
    public function show(MappingScale $mappingScale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MappingScale  $mappingScale
     * @return \Illuminate\Http\Response
     */
    public function edit(MappingScale $mappingScale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MappingScale  $mappingScale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $map_scale_id)
    {
        //
        $this->validate($request, [
            
            'title'=> 'required',
            'abbreviation'=> 'required',
            'description'=> 'required',
            'colour'=> 'required',

            ]);

        $ms = MappingScale::where('map_scale_id', $map_scale_id)->first();
        $ms->title = $request->input('title');
        $ms->abbreviation = $request->input('abbreviation');
        $ms->description = $request->input('description');
        $ms->colour = $request->input('colour');
        $ms->save();
        
        if($ms->save()){
            $request->session()->flash('success', 'Mapping scale level updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the mapping scale level');
        }
        
        return redirect()->route('programWizard.step3', $request->input('program_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingScale  $mappingScale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $map_scale_id)
    {
        //

        $ms = MappingScale::where('map_scale_id', $map_scale_id)->first();
        
        if($ms->delete()){
            $request->session()->flash('success', 'Mapping scale level deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the mapping scale level');
        }
        
        return redirect()->route('programWizard.step3', $request->input('program_id'));
    }

    public function default(Request $request)
    {
        //
        $ms = MappingScale::where('program_id', $request->input('program_id'))->delete();

        $ms1 = new MappingScale;
        $ms1->title = "Introduced";
        $ms1->abbreviation = "I";
        $ms1->description = "Key ideas, concepts or skills related to the learning outcome are demonstrated at an introductory level. Learning activities focus on basic knowledge, skills, and/or competencies and entry-level complexity.";
        $ms1->colour = "#0065bd";
        $ms1->program_id = $request->input('program_id');
        $ms1->save();

        $ms2 = new MappingScale;
        $ms2->title = "Developing";
        $ms2->abbreviation = "D";
        $ms2->description = "Learning outcome is reinforced with feedback; students demonstrate the outcome at an increasing level of proficiency. Learning activities concentrate on enhancing and strengthening existing knowledge and skills as well as expanding complexity.";
        $ms2->colour = "#1aa7ff";
        $ms2->program_id = $request->input('program_id');;
        $ms2->save();

        $ms3 = new MappingScale;
        $ms3->title = "Advanced";
        $ms3->abbreviation = "A";
        $ms3->description = "Students demonstrate the learning outcomes with a high level of independence, expertise and sophistication expected upon graduation. Learning activities focus on and integrate the use of content or skills in multiple.";
        $ms3->colour = "#80bdff";
        $ms3->program_id = $request->input('program_id');;
        
        if($ms3->save()){
            $request->session()->flash('success', 'Plo cateogry deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the plo category');
        }
        
        return redirect()->route('programWizard.step3', $request->input('program_id'));
    }
}
