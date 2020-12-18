<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\User;
use App\Models\Role;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\ProgramUser;
use Response;

class ProgramController extends Controller
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

    public function index()
    {
        //
        $programs = User::join('program_users', 'users.id', '=', 'program_users.user_id')
                ->join('programs', 'program_users.program_id', "=", 'programs.program_id')
                ->select('programs.program_id','programs.program', 'programs.faculty', 'programs.level', 'programs.department', 'programs.status')
                ->where('program_users.user_id','=',Auth::id())
                ->get();

        $user = User::where('id', Auth::id())->first();
        return view('programs.index')->with('user', $user)->with('programs', $programs);
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
            'program'=> 'required',
            'level'=> 'required',
            'faculty'=> 'required',
            ]);

        $program = new Program;
        $program->program = $request->input('program');
        $program->level = $request->input('level');
        $program->department = $request->input('department');
        $program->faculty = $request->input('faculty');
        $program->status = -1;

        $programuser = new ProgramUser;
        $programuser->user_id = $request->input('user_id');
        
        if($program->save()){
            $request->session()->flash('success', 'New program added');
        }else{
            $request->session()->flash('error', 'There was an error Adding the program');
        }

        $programuser->program_id = $program->program_id;
        $programuser->save();
        
        // $adminRole = Role::where('role','administrator')->first();
        // $user = User::where('id', Auth::id())->first();

        // if($user->hasRole('administrator') == false){
        //     $user->roles()->attach($adminRole);
        // }
        
        return redirect()->route('programs.index');

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
    public function update(Request $request, $program_id)
    {
        //
        $this->validate($request, [
            'program'=> 'required',
            'level'=> 'required',
            'faculty'=> 'required',
            ]);

        $program = Program::where('program_id', $program_id)->first();
        $program->program = $request->input('program');
        $program->level = $request->input('level');
        $program->department = $request->input('department');
        $program->faculty = $request->input('faculty');

        if($program->save()){
            $request->session()->flash('success', 'Program updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the program');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $program_id)
    {
        //
        $p = Program::where('program_id', $program_id);
        
        if($p->delete()){
            $request->session()->flash('success','Program has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the program');
        }

        return redirect()->route('programs.index');
    }

    public function submit(Request $request, $program_id)
    {
        //
        $p = Program::where('program_id', $program_id)->first();
        $p->status = 1;
        
        if($p->save()){
            $request->session()->flash('success','Program settings have been submitted');
        }else{
            $request->session()->flash('error', 'There was an error submitting the program settings');
        }

        return redirect()->route('programs.index');
    }
}
