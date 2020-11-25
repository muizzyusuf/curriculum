<?php

namespace App\Http\Controllers;

use App\Models\AssessmentMethod;
use Illuminate\Http\Request;

class AssessmentMethodController extends Controller
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
            'a_method'=> 'required',
            'weight'=> 'required',
            ]);

        $am = new AssessmentMethod;
        $am->a_method = $request->input('a_method');
        $am->weight = $request->input('weight');
        $am->course_id = $request->input('course_id');
        
        if($am->save()){
            $request->session()->flash('success', 'New student assessment method added');
        }else{
            $request->session()->flash('error', 'There was an error adding the student assessment method');
        }
        
        
        return redirect()->route('courseWizard.step2', $request->input('course_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssessmentMethod  $assessmentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(AssessmentMethod $assessmentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssessmentMethod  $assessmentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit($assessmentMethod)
    {
        //
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssessmentMethod  $assessmentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $a_method_id)
    {
        //
        $this->validate($request, [
            'a_method'=> 'required',
            'weight'=> 'required',
            ]);

        $am = AssessmentMethod::where('a_method_id', $a_method_id)->first();
        $am->a_method = $request->input('a_method');
        $am->weight = $request->input('weight');
        $am->course_id = $request->input('course_id');
        
        if($am->save()){
            $request->session()->flash('success', 'New student assessment method added');
        }else{
            $request->session()->flash('error', 'There was an error adding the student assessment method');
        }
        
        
        return redirect()->route('courseWizard.step2', $request->input('course_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssessmentMethod  $assessmentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $a_method_id)
    {
        $am = AssessmentMethod::where('a_method_id', $a_method_id)->first();
        $course_id = $request->input('course_id');


        if($am->delete()){
            $request->session()->flash('success','Student assessment method has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the student assessment method');
        }
        return redirect()->route('courseWizard.step2', $course_id);
    }
    
}
