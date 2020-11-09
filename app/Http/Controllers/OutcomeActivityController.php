<?php

namespace App\Http\Controllers;

use App\Models\OutcomeActivity;
use App\Models\LearningOutcome;
use Illuminate\Http\Request;

class OutcomeActivityController extends Controller
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
        $l_outcomes = LearningOutcome::where('course_id', $request->input('course_id'))->get();

        $i=0;
       
        foreach($l_outcomes as $l_outcome){

            if($request->input('l_activities')== null){

                $l_outcome->learningActivities()->detach();

            }elseif (array_key_exists($i,$request->input('l_activities'))){
                $arr=$request->input('l_activities');
                $l_outcome->learningActivities()->detach();
                $l_outcome->learningActivities()->sync($arr[$i]);
                
            }else{

                $l_outcome->learningActivities()->detach();
            }


            $i++;
        }

        return redirect()->route('courseWizard.step4', $request->input('course_id'))->with('success', 'Changes have been saved successfully. ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutcomeActivity  $outcomeActivity
     * @return \Illuminate\Http\Response
     */
    public function show(OutcomeActivity $outcomeActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutcomeActivity  $outcomeActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(OutcomeActivity $outcomeActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutcomeActivity  $outcomeActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutcomeActivity $outcomeActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutcomeActivity  $outcomeActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutcomeActivity $outcomeActivity)
    {
        //
    }
}
