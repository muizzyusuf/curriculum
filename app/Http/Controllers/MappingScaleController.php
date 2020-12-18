<?php

namespace App\Http\Controllers;

use App\Models\MappingScale;
use App\Models\MappingScaleProgram;
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
        $this->middleware(['auth', 'verified']);
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
        $ms->save();

        
        $msp = new MappingScaleProgram;
        $msp->map_scale_id = $ms->map_scale_id;
        $msp->program_id = $request->input('program_id');
        
        if($msp->save()){
            $request->session()->flash('success', 'Mapping scale level added');
        }else{
            $request->session()->flash('error', 'There was an error adding the mapping scale level');
        }
        
        return redirect()->route('programWizard.step2', $request->input('program_id'));
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
        
        if($ms->save()){
            $request->session()->flash('success', 'Mapping scale level updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the mapping scale level');
        }
        
        return redirect()->route('programWizard.step2', $request->input('program_id'));
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
        if($map_scale_id == 1 || $map_scale_id == 2 || $map_scale_id == 3){
            $msp = MappingScaleProgram::where('program_id', $request->input('program_id'))
                                        ->where('map_scale_id', $map_scale_id);
            if($msp->delete()){
                $request->session()->flash('success', 'Mapping scale level deleted');
            }else{
                $request->session()->flash('error', 'There was an error deleting the mapping scale level');
            }

        }else{    

            $ms = MappingScale::where('map_scale_id', $map_scale_id)->first();
        
            if($ms->delete()){
                $request->session()->flash('success', 'Mapping scale level deleted');
            }else{
                $request->session()->flash('error', 'There was an error deleting the mapping scale level');
            }

        }
        
        return redirect()->route('programWizard.step2', $request->input('program_id'));
    }

    public function default(Request $request)
    {
        //
        $msp = MappingScaleProgram::where('program_id',  $request->input('program_id') )->get();
        //dd($msp);

        foreach($msp as $m){
            $ms = MappingScale::where('map_scale_id', $m->map_scale_id)->first();
            if($m->map_scale_id == 1 || $m->map_scale_id == 2 || $m->map_scale_id == 3){
                $ms->programs()->detach($request->input('program_id'));
            }else{
                $ms->delete();
            }
        }

        $msp1 = new MappingScaleProgram;
        $msp1->map_scale_id = 1;
        $msp1->program_id = $request->input('program_id');
        $msp1->save();

        $msp2 = new MappingScaleProgram;
        $msp2->map_scale_id = 2;
        $msp2->program_id = $request->input('program_id');
        $msp2->save();

        $msp3 = new MappingScaleProgram;
        $msp3->map_scale_id = 3;
        $msp3->program_id = $request->input('program_id');
        
        if($msp3->save()){
            $request->session()->flash('success', 'default mapping scale value set');
        }else{
            $request->session()->flash('error', 'There was an error deleting the plo category');
        }
        
        return redirect()->route('programWizard.step2', $request->input('program_id'));
    }
}
