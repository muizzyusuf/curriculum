<?php

namespace App\Http\Controllers;

use App\Models\ProgramLearningOutcome;
use App\Models\LearningOutcome;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutcomeMapController extends Controller
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
        $course_id = $request->input('course_id');

        $l_outcomes = LearningOutcome::where('course_id', $course_id)->get();
        $course =  Course::where('course_id', $course_id)->first();
        $pl_outcomes = ProgramLearningOutcome::where('program_id', $course->program_id)->get();

        $arr = $request->input('map');
        
        foreach($l_outcomes as $l_outcome){
            
            foreach($pl_outcomes as $pl_outcome){

                $outcomeMap = DB::table('outcome_maps')->updateOrInsert(
                    ['pl_outcome_id' =>$pl_outcome->pl_outcome_id , 'l_outcome_id' => $l_outcome->l_outcome_id ],
                    ['map_scale_value' => $arr[$l_outcome->l_outcome_id][$pl_outcome->pl_outcome_id]]
                );    
            }  
        }

        return redirect()->route('courseWizard.step5', $request->input('course_id'))->with('success', 'Your answers have been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutcomeMap  $outcomeMap
     * @return \Illuminate\Http\Response
     */
    public function show(OutcomeMap $outcomeMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutcomeMap  $outcomeMap
     * @return \Illuminate\Http\Response
     */
    public function edit(OutcomeMap $outcomeMap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutcomeMap  $outcomeMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutcomeMap $outcomeMap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutcomeMap  $outcomeMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutcomeMap $outcomeMap)
    {
        //
    }
}
