<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\ProgramUser;
use App\Models\CourseUser;
use App\Models\User;
use App\Models\ProgramLearningOutcome;
use App\Models\Course;
use App\Models\LearningOutcome;
use App\Models\AssessmentMethod;
use App\Models\OutcomeAssessment;
use App\Models\LearningActivity;
use App\Models\OutcomeActivity;
use App\Models\MappingScale;
use App\Models\PLOCategory;
use Illuminate\Support\Facades\Auth;

class CourseWizardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('courseWizard');
    }

    // public function step0($course_id)
    // {
       
    //     $course =  Course::where('course_id', $course_id)->first();
    //     $user = User::where('id',Auth::id())->first();
    //     $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
    //                             ->join('users','course_users.user_id',"=","users.id")
    //                             ->select('users.email')
    //                             ->where('courses.course_id','=',$course_id)->get();
        

    //     return view('courses.wizard.step0')->with('course', $course)->with('courseUsers', $courseUsers)->with('user', $user);
        
    // }


    public function step1($course_id)
    {
        //for header
        $user = User::where('id',Auth::id())->first();
        $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
                                ->join('users','course_users.user_id',"=","users.id")
                                ->select('users.email')
                                ->where('courses.course_id','=',$course_id)->get();

        //for progress bar
        $lo_count = LearningOutcome::where('course_id', $course_id)->count();
        $am_count = AssessmentMethod::where('course_id', $course_id)->count();
        $la_count = LearningActivity::where('course_id', $course_id)->count();
        $oAct = LearningActivity::join('outcome_activities','learning_activities.l_activity_id','=','outcome_activities.l_activity_id')
                                ->join('learning_outcomes', 'outcome_activities.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_activities.l_activity_id','learning_activities.l_activity','outcome_activities.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_activities.course_id','=',$course_id)->count();
        $oAss = AssessmentMethod::join('outcome_assessments','assessment_methods.a_method_id','=','outcome_assessments.a_method_id')
                                ->join('learning_outcomes', 'outcome_assessments.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('assessment_methods.a_method_id','assessment_methods.a_method','outcome_assessments.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('assessment_methods.course_id','=',$course_id)->count();
        $outcomeMaps = ProgramLearningOutcome::join('outcome_maps','program_learning_outcomes.pl_outcome_id','=','outcome_maps.pl_outcome_id')
                                ->join('learning_outcomes', 'outcome_maps.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_maps.map_scale_value','outcome_maps.pl_outcome_id','program_learning_outcomes.pl_outcome','outcome_maps.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_outcomes.course_id','=',$course_id)->count();

        //
        $l_outcomes = LearningOutcome::where('course_id', $course_id)->get();
        $course =  Course::where('course_id', $course_id)->first();

        return view('courses.wizard.step1')->with('l_outcomes', $l_outcomes)->with('course', $course)->with('courseUsers', $courseUsers)->with('user', $user)
                                        ->with('lo_count',$lo_count)->with('am_count', $am_count)->with('la_count', $la_count)->with('oAct', $oAct)->with('oAss', $oAss)->with('outcomeMaps', $outcomeMaps);
        
    }

    public function step2($course_id)
    {   
        //for header
        $user = User::where('id',Auth::id())->first();
        $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
                                ->join('users','course_users.user_id',"=","users.id")
                                ->select('users.email')
                                ->where('courses.course_id','=',$course_id)->get();

        //for progress bar
        $lo_count = LearningOutcome::where('course_id', $course_id)->count();
        $am_count = AssessmentMethod::where('course_id', $course_id)->count();
        $la_count = LearningActivity::where('course_id', $course_id)->count();
        $oAct = LearningActivity::join('outcome_activities','learning_activities.l_activity_id','=','outcome_activities.l_activity_id')
                                ->join('learning_outcomes', 'outcome_activities.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_activities.l_activity_id','learning_activities.l_activity','outcome_activities.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_activities.course_id','=',$course_id)->count();
        $oAss = AssessmentMethod::join('outcome_assessments','assessment_methods.a_method_id','=','outcome_assessments.a_method_id')
                                ->join('learning_outcomes', 'outcome_assessments.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('assessment_methods.a_method_id','assessment_methods.a_method','outcome_assessments.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('assessment_methods.course_id','=',$course_id)->count();
        $outcomeMaps = ProgramLearningOutcome::join('outcome_maps','program_learning_outcomes.pl_outcome_id','=','outcome_maps.pl_outcome_id')
                                ->join('learning_outcomes', 'outcome_maps.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_maps.map_scale_value','outcome_maps.pl_outcome_id','program_learning_outcomes.pl_outcome','outcome_maps.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_outcomes.course_id','=',$course_id)->count();
        
        //
        $a_methods = AssessmentMethod::where('course_id', $course_id)->get();
        $totalWeight = AssessmentMethod::where('course_id', $course_id)->sum('weight');
        $course =  Course::where('course_id', $course_id)->first();

        return view('courses.wizard.step2')->with('a_methods', $a_methods)->with('course', $course)->with("totalWeight", $totalWeight)->with('courseUsers', $courseUsers)->with('user', $user)
                                        ->with('lo_count',$lo_count)->with('am_count', $am_count)->with('la_count', $la_count)->with('oAct', $oAct)->with('oAss', $oAss)->with('outcomeMaps', $outcomeMaps);
        
        
    }

    public function step3($course_id)
    {   
        //for header
        $user = User::where('id',Auth::id())->first();
        $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
                                ->join('users','course_users.user_id',"=","users.id")
                                ->select('users.email')
                                ->where('courses.course_id','=',$course_id)->get();
        
        //for progress bar
        $lo_count = LearningOutcome::where('course_id', $course_id)->count();
        $am_count = AssessmentMethod::where('course_id', $course_id)->count();
        $la_count = LearningActivity::where('course_id', $course_id)->count();
        $oAct = LearningActivity::join('outcome_activities','learning_activities.l_activity_id','=','outcome_activities.l_activity_id')
                                ->join('learning_outcomes', 'outcome_activities.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_activities.l_activity_id','learning_activities.l_activity','outcome_activities.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_activities.course_id','=',$course_id)->count();
        $oAss = AssessmentMethod::join('outcome_assessments','assessment_methods.a_method_id','=','outcome_assessments.a_method_id')
                                ->join('learning_outcomes', 'outcome_assessments.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('assessment_methods.a_method_id','assessment_methods.a_method','outcome_assessments.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('assessment_methods.course_id','=',$course_id)->count();
        $outcomeMaps = ProgramLearningOutcome::join('outcome_maps','program_learning_outcomes.pl_outcome_id','=','outcome_maps.pl_outcome_id')
                                ->join('learning_outcomes', 'outcome_maps.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_maps.map_scale_value','outcome_maps.pl_outcome_id','program_learning_outcomes.pl_outcome','outcome_maps.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_outcomes.course_id','=',$course_id)->count();
        //

        $l_activities = LearningActivity::where('course_id', $course_id)->get();
        $course =  Course::where('course_id', $course_id)->first();

        return view('courses.wizard.step3')->with('l_activities', $l_activities)->with('course', $course)->with('courseUsers', $courseUsers)->with('user', $user)
                                        ->with('lo_count',$lo_count)->with('am_count', $am_count)->with('la_count', $la_count)->with('oAct', $oAct)->with('oAss', $oAss)->with('outcomeMaps', $outcomeMaps);
        
    }

    public function step4($course_id)
    {
        //for header
        $user = User::where('id',Auth::id())->first();
        $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
                                ->join('users','course_users.user_id',"=","users.id")
                                ->select('users.email')
                                ->where('courses.course_id','=',$course_id)->get();
        //for progress bar
        $lo_count = LearningOutcome::where('course_id', $course_id)->count();
        $am_count = AssessmentMethod::where('course_id', $course_id)->count();
        $la_count = LearningActivity::where('course_id', $course_id)->count();
        $oAct = LearningActivity::join('outcome_activities','learning_activities.l_activity_id','=','outcome_activities.l_activity_id')
                                ->join('learning_outcomes', 'outcome_activities.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_activities.l_activity_id','learning_activities.l_activity','outcome_activities.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_activities.course_id','=',$course_id)->count();
        $oAss = AssessmentMethod::join('outcome_assessments','assessment_methods.a_method_id','=','outcome_assessments.a_method_id')
                                ->join('learning_outcomes', 'outcome_assessments.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('assessment_methods.a_method_id','assessment_methods.a_method','outcome_assessments.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('assessment_methods.course_id','=',$course_id)->count();
        $outcomeMaps = ProgramLearningOutcome::join('outcome_maps','program_learning_outcomes.pl_outcome_id','=','outcome_maps.pl_outcome_id')
                                ->join('learning_outcomes', 'outcome_maps.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_maps.map_scale_value','outcome_maps.pl_outcome_id','program_learning_outcomes.pl_outcome','outcome_maps.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_outcomes.course_id','=',$course_id)->count();
        
        //
        $l_outcomes = LearningOutcome::where('course_id', $course_id)->get();
        $course =  Course::where('course_id', $course_id)->first();
        $l_activities = LearningActivity::where('course_id', $course_id)->get();
        $a_methods = AssessmentMethod::where('course_id', $course_id)->get();

        return view('courses.wizard.step4')->with('l_outcomes', $l_outcomes)->with('course', $course)->with('l_activities', $l_activities)->with('a_methods', $a_methods)->with('courseUsers', $courseUsers)->with('user', $user)
                        ->with('lo_count',$lo_count)->with('am_count', $am_count)->with('la_count', $la_count)->with('oAct', $oAct)->with('oAss', $oAss)->with('outcomeMaps', $outcomeMaps);
    }

    public function step5($course_id)
    {
        //for header
        $user = User::where('id',Auth::id())->first();
        $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
                                ->join('users','course_users.user_id',"=","users.id")
                                ->select('users.email')
                                ->where('courses.course_id','=',$course_id)->get();
        
        //for progress bar
        $lo_count = LearningOutcome::where('course_id', $course_id)->count();
        $am_count = AssessmentMethod::where('course_id', $course_id)->count();
        $la_count = LearningActivity::where('course_id', $course_id)->count();
        $oAct = LearningActivity::join('outcome_activities','learning_activities.l_activity_id','=','outcome_activities.l_activity_id')
                                ->join('learning_outcomes', 'outcome_activities.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_activities.l_activity_id','learning_activities.l_activity','outcome_activities.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_activities.course_id','=',$course_id)->count();
        $oAss = AssessmentMethod::join('outcome_assessments','assessment_methods.a_method_id','=','outcome_assessments.a_method_id')
                                ->join('learning_outcomes', 'outcome_assessments.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('assessment_methods.a_method_id','assessment_methods.a_method','outcome_assessments.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('assessment_methods.course_id','=',$course_id)->count();
        $outcomeMaps = ProgramLearningOutcome::join('outcome_maps','program_learning_outcomes.pl_outcome_id','=','outcome_maps.pl_outcome_id')
                                ->join('learning_outcomes', 'outcome_maps.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_maps.map_scale_value','outcome_maps.pl_outcome_id','program_learning_outcomes.pl_outcome','outcome_maps.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_outcomes.course_id','=',$course_id)->count();
        
        //
        $l_outcomes = LearningOutcome::where('course_id', $course_id)->get();
        $course =  Course::where('course_id', $course_id)->first();
        $pl_outcomes = ProgramLearningOutcome::where('program_id', $course->program_id)->get();
        // $mappingScales = MappingScale::where('program_id', $course->program_id)->get();
        $mappingScales = MappingScale::join('mapping_scale_programs', 'mapping_scales.map_scale_id', "=", 'mapping_scale_programs.map_scale_id')
                            ->where('mapping_scale_programs.program_id', $course->program_id)->get();

        

        return view('courses.wizard.step5')->with('l_outcomes', $l_outcomes)->with('course', $course)->with('pl_outcomes',$pl_outcomes)->with('mappingScales', $mappingScales)->with('courseUsers', $courseUsers)->with('user', $user)
                                        ->with('lo_count',$lo_count)->with('am_count', $am_count)->with('la_count', $la_count)->with('oAct', $oAct)->with('oAss', $oAss)->with('outcomeMaps', $outcomeMaps);
    }

    public function step6($course_id)
    {   
        //for header
        $user = User::where('id',Auth::id())->first();
        $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
                                ->join('users','course_users.user_id',"=","users.id")
                                ->select('users.email')
                                ->where('courses.course_id','=',$course_id)->get();
        
        //for progress bar
        $lo_count = LearningOutcome::where('course_id', $course_id)->count();
        $am_count = AssessmentMethod::where('course_id', $course_id)->count();
        $la_count = LearningActivity::where('course_id', $course_id)->count();
        $oAct = LearningActivity::join('outcome_activities','learning_activities.l_activity_id','=','outcome_activities.l_activity_id')
                                ->join('learning_outcomes', 'outcome_activities.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_activities.l_activity_id','learning_activities.l_activity','outcome_activities.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_activities.course_id','=',$course_id)->count();
        $oAss = AssessmentMethod::join('outcome_assessments','assessment_methods.a_method_id','=','outcome_assessments.a_method_id')
                                ->join('learning_outcomes', 'outcome_assessments.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('assessment_methods.a_method_id','assessment_methods.a_method','outcome_assessments.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('assessment_methods.course_id','=',$course_id)->count();
        $outcomeMapsCount = ProgramLearningOutcome::join('outcome_maps','program_learning_outcomes.pl_outcome_id','=','outcome_maps.pl_outcome_id')
                                ->join('learning_outcomes', 'outcome_maps.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_maps.map_scale_value','outcome_maps.pl_outcome_id','program_learning_outcomes.pl_outcome','outcome_maps.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_outcomes.course_id','=',$course_id)->count();

        //
        $course =  Course::where('course_id', $course_id)->first();
        $program = Program::where('program_id', $course->program_id)->first();
        $a_methods = AssessmentMethod::where('course_id', $course_id)->get();
        $l_activities = LearningActivity::where('course_id', $course_id)->get();
        $l_outcomes = LearningOutcome::where('course_id', $course_id)->get();
        $pl_outcomes = ProgramLearningOutcome::where('program_id', $course->program_id)->get();
        // $mappingScales = MappingScale::where('program_id', $course->program_id)->get();
        $mappingScales = MappingScale::join('mapping_scale_programs', 'mapping_scales.map_scale_id', "=", 'mapping_scale_programs.map_scale_id')
                            ->where('mapping_scale_programs.program_id', $course->program_id)->get();
        $ploCategories = PLOCategory::where('program_id', $course->program_id)->get();

        $outcomeActivities = LearningActivity::join('outcome_activities','learning_activities.l_activity_id','=','outcome_activities.l_activity_id')
                                ->join('learning_outcomes', 'outcome_activities.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_activities.l_activity_id','learning_activities.l_activity','outcome_activities.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_activities.course_id','=',$course_id)->get();

        $outcomeAssessments = AssessmentMethod::join('outcome_assessments','assessment_methods.a_method_id','=','outcome_assessments.a_method_id')
                                ->join('learning_outcomes', 'outcome_assessments.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('assessment_methods.a_method_id','assessment_methods.a_method','outcome_assessments.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('assessment_methods.course_id','=',$course_id)->get();

        $outcomeMaps = ProgramLearningOutcome::join('outcome_maps','program_learning_outcomes.pl_outcome_id','=','outcome_maps.pl_outcome_id')
                                ->join('learning_outcomes', 'outcome_maps.l_outcome_id', '=', 'learning_outcomes.l_outcome_id' )
                                ->select('outcome_maps.map_scale_value','outcome_maps.pl_outcome_id','program_learning_outcomes.pl_outcome','outcome_maps.l_outcome_id', 'learning_outcomes.l_outcome')
                                ->where('learning_outcomes.course_id','=',$course_id)->get();
        

        return view('courses.wizard.step6')->with('course', $course)
                                        ->with('program', $program)
                                        ->with('l_outcomes', $l_outcomes)
                                        ->with('pl_outcomes',$pl_outcomes)
                                        ->with('l_activities', $l_activities)
                                        ->with('a_methods', $a_methods)
                                        ->with('outcomeActivities', $outcomeActivities)
                                        ->with('outcomeAssessments', $outcomeAssessments)
                                        ->with('outcomeMaps', $outcomeMaps)
                                        ->with('mappingScales', $mappingScales)
                                        ->with('ploCategories', $ploCategories)
                                        ->with('courseUsers', $courseUsers)->with('user', $user)->with('lo_count',$lo_count)->with('am_count', $am_count)->with('la_count', $la_count)->with('oAct', $oAct)->with('oAss', $oAss)->with('outcomeMapsCount', $outcomeMapsCount);
    }

    // public function step7($course_id)
    // {
    //     $user = User::where('id',Auth::id())->first();
    //     $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
    //                             ->join('users','course_users.user_id',"=","users.id")
    //                             ->select('users.email')
    //                             ->where('courses.course_id','=',$course_id)->get();
    //     //
    //     $course =  Course::where('course_id', $course_id)->first();

    //     return view('courses.wizard.step7')->with('course', $course)->with('courseUsers', $courseUsers)->with('user', $user);
                                        
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
