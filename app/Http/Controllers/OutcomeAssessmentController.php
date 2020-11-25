<?php

namespace App\Http\Controllers;

use App\Models\OutcomeAssessment;
use App\Models\LearningOutcome;
use Illuminate\Http\Request;

class OutcomeAssessmentController extends Controller
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
        $l_outcomes = LearningOutcome::where('course_id', $request->input('course_id'))->get();

        $i=0;
       
        foreach($l_outcomes as $l_outcome){

            if($request->input('a_methods')== null){

                $l_outcome->assessmentMethods()->detach();

            }elseif (array_key_exists($i,$request->input('a_methods'))){
                $arr=$request->input('a_methods');
                $l_outcome->assessmentMethods()->detach();
                $l_outcome->assessmentMethods()->sync($arr[$i]);
                
            }else{

                $l_outcome->assessmentMethods()->detach();
            }


            $i++;
        }

        return redirect()->route('courseWizard.step4', $request->input('course_id'))->with('success', 'Changes have been saved successfully. ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutcomeAssessment  $outcomeAssessment
     * @return \Illuminate\Http\Response
     */
    public function show(OutcomeAssessment $outcomeAssessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutcomeAssessment  $outcomeAssessment
     * @return \Illuminate\Http\Response
     */
    public function edit(OutcomeAssessment $outcomeAssessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutcomeAssessment  $outcomeAssessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutcomeAssessment $outcomeAssessment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutcomeAssessment  $outcomeAssessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutcomeAssessment $outcomeAssessment)
    {
        //
    }
}
