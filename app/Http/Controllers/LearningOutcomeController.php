<?php

namespace App\Http\Controllers;

use App\Models\LearningOutcome;
use Illuminate\Http\Request;

class LearningOutcomeController extends Controller
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
            'l_outcome'=> 'required',
            ]);

        $lo = new LearningOutcome;
        $lo->clo_shortphrase = $request->input('title');
        $lo->l_outcome = $request->input('l_outcome');
        $lo->course_id = $request->input('course_id');
        
        if($lo->save()){
            $request->session()->flash('success', 'New course learning outcome added');
        }else{
            $request->session()->flash('error', 'There was an error adding the course learning outcome');
        }
        
        return redirect()->route('courseWizard.step1', $request->input('course_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LearningOutcome  $learningOutcome
     * @return \Illuminate\Http\Response
     */
    public function show(LearningOutcome $learningOutcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LearningOutcome  $learningOutcome
     * @return \Illuminate\Http\Response
     */
    public function edit($learningOutcome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LearningOutcome  $learningOutcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $l_outcome_id)
    {
        //
        $this->validate($request, [
            'l_outcome'=> 'required',
            ]);

        $lo = LearningOutcome::where('l_outcome_id', $l_outcome_id)->first();
        $lo->l_outcome = $request->input('l_outcome');
        $lo->clo_shortphrase = $request->input('title');
        
        if($lo->save()){
            $request->session()->flash('success', 'Course learning outcome updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the course learning outcome');
        }
        
        return redirect()->route('courseWizard.step1', $request->input('course_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LearningOutcome  $learningOutcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $l_outcome_id)
    {
        //
        $lo = LearningOutcome::where('l_outcome_id', $l_outcome_id)->first();


        if($lo->delete()){
            $request->session()->flash('success','Course learning outcome has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the course learning outcome');
        }
        return redirect()->route('courseWizard.step1', $request->input('course_id'));
    }
}
