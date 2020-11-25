<?php

namespace App\Http\Controllers;

use App\Models\LearningActivity;
use Illuminate\Http\Request;

class LearningActivityController extends Controller
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
            'l_activity'=> 'required',
            ]);

        $la = new LearningActivity;
        $la->l_activity = $request->input('l_activity');
        $la->course_id = $request->input('course_id');
        
        if($la->save()){
            $request->session()->flash('success', 'New teaching/learning activity added');
        }else{
            $request->session()->flash('error', 'There was an error adding the teaching/learning activity');
        }
        
        return redirect()->route('courseWizard.step3', $request->input('course_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LearningActivity  $learningActivity
     * @return \Illuminate\Http\Response
     */
    public function show(LearningActivity $learningActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LearningActivity  $learningActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(LearningActivity $learningActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LearningActivity  $learningActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LearningActivity $learningActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LearningActivity  $learningActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $l_activity_id)
    {
        //
        $la = learningActivity::where('l_activity_id', $l_activity_id)->first();
        $course_id = $request->input('course_id');


        if($la->delete()){
            $request->session()->flash('success','Teaching/learning activity has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the teaching/learning activity');
        } 
        return redirect()->route('courseWizard.step3', $request->input('course_id'));
    }
}
