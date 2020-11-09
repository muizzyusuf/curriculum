<?php

namespace App\Http\Controllers;

use App\Models\CourseUser;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseUserController extends Controller
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
    public function store(Request $request, $course_id)
    {
        //
        
        $this->validate($request, [
            'email'=> 'required',
            'email'=> 'exists:users,email',
            ]);

        $course = Course::where('course_id',$course_id)->first();
        $user = User::where('email', $request->input('email'))->first();

        $course->assigned = 1;

        $courseUser = new CourseUser;
        $courseUser->course_id = $course_id;
        $courseUser->program_id = $request->input('program_id');
        $courseUser->user_id = $user->id;

         
        if($courseUser->save()){
            $request->session()->flash('success', 'Course '.$course->course_code.''.$course->course_num.' successfully assigned to '.$user->email);
        }else{
            $request->session()->flash('error', 'There was an error assigning the course');
        }

        $course->save();

        return redirect()->route('programWizard.step4', $request->input('program_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseUser  $courseUser
     * @return \Illuminate\Http\Response
     */
    public function show(CourseUser $courseUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseUser  $courseUser
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseUser $courseUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseUser  $courseUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseUser $courseUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseUser  $courseUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $course_id)
    {
        //
        
        $course = Course::where('course_id',$course_id)->first();
        
        $user = User::where('email', $request->input('email'))->first();
        
        $courseUser = CourseUser::where('course_id', $course_id)->where('user_id',$user->id);

        if($courseUser->delete()){
            $request->session()->flash('success', $user->email.' successfully unassigned');
        }else{
            $request->session()->flash('error', 'There was an error unassigning the administrator');
        }

        $courseUsers = CourseUser::where('course_id', $course_id)->where('program_id',$request->input('program_id'))->get();
        if (count($courseUsers) == 0){
            $course->assigned = -1;
        }

        $course->save();

        return redirect()->route('programWizard.step4', $request->input('program_id'));
    }
}
