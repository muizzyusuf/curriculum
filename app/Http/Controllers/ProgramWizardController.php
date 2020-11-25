<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\ProgramUser;
use App\Models\CourseUser;
use App\Models\User;
use App\Models\PLOCategory;
use App\Models\ProgramLearningOutcome;
use App\Models\Course;
use App\Models\MappingScale;
use Illuminate\Support\Facades\Auth;

class ProgramWizardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function step1($program_id)
    {
        //
        $faculties = array("Arts and Social Sciences", "Creative and Critical Studies", "Education", "Applied Science", "Health and Social Development", "Management", "Science", "Medicine", "Graduate Studies", "Other");
        $departments = array("Engineering", "Education", "Community, Culture and Global Studies", "Economics, Philosophy and Political Science", "History and Sociology", "Psychology", "Creative Studies", "Languages and World Literature", "English and Cultural Studies", "Biology", "Chemistry", "Computer Science, Mathematics, Physics and Statistics", "Earth, Environmental and Geographic Sciences", "Health and Exercise Sciences", "Nursing", "Social Work", "Management", "Graduate Studies", "Other" );
        $levels = array("Undergraduate", "Graduate");
        $program = Program::where('program_id', $program_id)->first();
        $user = User::where('id',Auth::id())->first();
        $programUsers = ProgramUser::join('users','program_users.user_id',"=","users.id")
                                ->select('users.email','program_users.user_id','program_users.program_id')
                                ->where('program_users.program_id','=',$program_id)->get();

        return view('programs.wizard.step1')->with('program', $program)->with("faculties", $faculties)->with("departments", $departments)->with("levels",$levels)->with('user', $user)->with('programUsers',$programUsers);
    }

    public function step2($program_id)
    {
        //
        $plos = ProgramLearningOutcome::where('program_id', $program_id)->get();
        $program = Program::where('program_id', $program_id)->first();
        $ploCategories = PLOCategory::where('program_id', $program_id)->get();
       

        return view('programs.wizard.step2')->with('plos', $plos)->with('program', $program)->with('ploCategories', $ploCategories);
    }

    public function step3($program_id)
    {
        //
        $mappingScales = MappingScale::join('mapping_scale_programs', 'mapping_scales.map_scale_id', "=", 'mapping_scale_programs.map_scale_id')
                                    ->where('mapping_scale_programs.program_id', $program_id)->get();
        $program = Program::where('program_id', $program_id)->first();
       

        return view('programs.wizard.step3')->with('mappingScales', $mappingScales)->with('program', $program);
    }

    public function step4($program_id)
    {
        //
        
        $program = Program::where('program_id', $program_id)->first();
        $courses = Course::where('program_id', $program_id)->get();
                
        $courseUsers = Course::join('course_users','courses.course_id',"=","course_users.course_id")
                                ->join('users','course_users.user_id',"=","users.id")
                                ->select('users.email', 'course_users.course_id')
                                ->where('courses.program_id','=',$program_id)->get();
       

        return view('programs.wizard.step4')->with('program', $program)->with('courses', $courses)->with('courseUsers',$courseUsers);
    }

    public function step5($program_id)
    {
        //
        $program = Program::where('program_id', $program_id)->first();
       

        return view('programs.wizard.step5')->with('program', $program);
    }


    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
