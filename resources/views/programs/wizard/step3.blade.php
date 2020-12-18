@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('programs.wizard.header')
            
            <!-- progress bar -->
            <div>
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tr>
                        <td><a class="btn @if($ploCount<1) btn-secondary @else btn-success @endif" href="{{route('programWizard.step1', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>1</b> </a></td>
                        <td><a class="btn @if($msCount<1) btn-secondary @else btn-success @endif" href="{{route('programWizard.step2', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>2</b> </a></td>
                        <td><a class="btn btn-primary" href="{{route('programWizard.step3', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>3</b> </a></td>
                        <td><a class="btn btn-secondary" href="{{route('programWizard.step4', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>4</b> </a></td>
                    </tr>
                    <tr>
                        <td>Program Learning Outcomes</td>
                        <td>Mapping Scale</td>
                        <td>Courses</td>
                        <td>Begin Mapping Program</td>
                    </tr>
                </table>
            </div>

            <div class="card">

                <div class="card-body">
                    <p class="form-text text-muted">Input the required and non-required courses for this program (to the best of your knowledge). <strong>All courses need to have at least one assigned instructor to be mapped to a program.</strong></p>

                    <div id="courses">
                        <div class="row">
                            <div class="col">
                                <table class="table table-borderless">

                                    @if(count($courses)<1) 
                                        <tr class="table-active">
                                            <th colspan="2">There are no courses for this program project.</th>
                                        </tr>


                                        @else

                                        <tr class="table-active">
                                            <th>Course(s)</th>
                                            <th>Assigned</th>
                                            <th>Status</th>
                                            <th width="30%"></th>
                                        </tr>
                                        
                                            @foreach($courses as $course)
                                                <tr>
                                                    <td>{{$course->course_code}}{{$course->course_num}} -
                                                        {{$course->course_title}}
                                                        <p class="form-text text-muted">@if($course->required == 1)Required @elseif($course->required == -1) Not Required @endif</p>
                                                    </td>
                                                    <td>
                                                        @if($course->assigned == -1)
                                                        ❗Unassigned
                                                        @else
                                                        ✔️Assigned
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($course->status == -1)
                                                        ❗In Progress
                                                        @else
                                                        ✔️Completed
                                                        @endif
                                                    </td>
                                                    <td>
                                                        
                                                        <!-- Delete button -->
                                                        <form action="{{route('courses.destroy', $course->course_id)}}" method="POST" class="float-right ml-2">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <input type="hidden" class="form-check-input " name="program_id" value={{$program->program_id}}>
                                                            <button style="width:60px" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                        
                                                        <!-- Edit button -->
                                                        <button type="button" style="width:60px" class="btn btn-secondary btn-sm float-right ml-2" data-toggle="modal" data-target="#editCourseModal{{$course->course_id}}">
                                                            Edit
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="editCourseModal{{$course->course_id}}" tabindex="-1"
                                                            role="dialog" aria-labelledby="editCourseModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editCourseModalLabel">
                                                                            Edit
                                                                            Course</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <form method="POST"
                                                                        action="{{ action('CourseController@update', $course->course_id) }}">
                                                                        @csrf
                                                                        {{method_field('PUT')}}

                                                                        <div class="modal-body">


                                                                            <div class="form-group row">
                                                                                <label for="course_code"
                                                                                    class="col-md-2 col-form-label text-md-right">Course
                                                                                    Code</label>

                                                                                <div class="col-md-8">
                                                                                    <input id="course_code" type="text"
                                                                                        pattern="[A-Za-z]{4}"
                                                                                class="form-control @error('course_code') is-invalid @enderror" value="{{$course->course_code}}"
                                                                                        name="course_code" required autofocus>
                                                
                                                                                    @error('course_code')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                    <small id="helpBlock" class="form-text text-muted">
                                                                                        Four letter course code e.g. SUST, COSC etc.
                                                                                    </small>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="course_num"
                                                                                    class="col-md-2 col-form-label text-md-right">Course
                                                                                    Number</label>

                                                                                <div class="col-md-8">
                                                                                    <input id="course_num" type="number"
                                                                                        class="form-control @error('course_num') is-invalid @enderror"
                                                                                        name="course_num"
                                                                                        value="{{$course->course_num}}"
                                                                                        required autofocus>

                                                                                    @error('course_num')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="course_title"
                                                                                    class="col-md-2 col-form-label text-md-right">Course
                                                                                    Title</label>

                                                                                <div class="col-md-8">
                                                                                    <input id="course_title" type="text"
                                                                                        class="form-control @error('course_title') is-invalid @enderror"
                                                                                        name="course_title"
                                                                                        value="{{$course->course_title}}"
                                                                                        required autofocus>

                                                                                    @error('course_title')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="required"
                                                                                    class="col-md-2 col-form-label text-md-right">Required</label>
                                                                                <div class="col-md-6">
                                                                                    
                                                                                        @if($course->required == -1)
                                                                                            <div class="form-check ">
                                                                                                <label class="form-check-label">
                                                                                                    <input type="radio" class="form-check-input" name="required" value="1">
                                                                                                    Required
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <label class="form-check-label">
                                                                                                    <input type="radio" class="form-check-input" name="required" value="-1" checked>
                                                                                                    Not Required
                                                                                                </label>
                                                                                            </div>
                                                                                        @elseif($course->required == 1)
                                                                                            <div class="form-check ">
                                                                                                <label class="form-check-label">
                                                                                                    <input type="radio" class="form-check-input" name="required" value="1" checked>
                                                                                                    Required
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <label class="form-check-label">
                                                                                                    <input type="radio" class="form-check-input" name="required" value="-1" >
                                                                                                    Not Required
                                                                                                </label>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="form-check ">
                                                                                                <label class="form-check-label">
                                                                                                    <input type="radio" class="form-check-input" name="required" value="1" >
                                                                                                    Required
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <label class="form-check-label">
                                                                                                    <input type="radio" class="form-check-input" name="required" value="-1" >
                                                                                                    Not Required
                                                                                                </label>
                                                                                            </div>

                                                                                        @endif
                                                                                        <small class="form-text text-muted">
                                                                                            Is this course required by the program?
                                                                                        </small>    
                                                                                </div>
                                                                            </div>

                                                                            <input type="hidden" class="form-input"
                                                                                name="program_id"
                                                                                value={{$program->program_id}}>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary col-2 btn-sm"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary col-2 btn-sm">Save</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                
                                                        <!-- Assign instructor button  -->
                                                        <button type="button" style="width:120px" class="btn btn-outline-primary btn-sm ml-2 float-right" data-toggle="modal" data-target="#assignInstructorModal{{$course->course_id}}">
                                                           Assign Instructor
                                                        </button>

                                                        <!-- Modal --> 
                                                        <div class="modal fade" id="assignInstructorModal{{$course->course_id}}" tabindex="-1" role="dialog" aria-labelledby="assignInstructorModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="assignInstructorModalLabel">Assign Instructor to course</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="container">
                                                                        <p class="form-text text-muted"> 
                                                                            Instructors can see and edit the course (not the program). Instructors must first register with this web application to be assigned to a course.
                                                                            By adding an instructor, a verification email will be sent to their email address. <Strong>You can assign the course to yourself by clicking "Assign to Self"</Strong>.  
                                                                        </p>
                                                                        <table class="table table-borderless">
                                
                                                                            <tr class="table-active">
                                                                                <th colspan="2">Instructor</th>
                                                                            </tr>
                                                                            <div>
                                                                                @foreach($courseUsers as $instructor)
                                                                            
                                                                                    @if($course->course_id == $instructor->course_id)
                                                                                        <tr>
                                                                                            <td>{{$instructor->email}}</td>
                                                                                            <td>
                                                                                                <form action="{{route('courses.unassign', $course->course_id)}}" method="POST" class="float-right ml-2">
                                                                                                    @csrf
                                                                                                    {{method_field('DELETE')}}
                                                                                                    <input type="hidden" class="form-check-input" name="program_id" value="{{$course->program_id}}">
                                                                                                    <input type="hidden" class="form-check-input" name="email" value="{{$instructor->email}}">
                                                                                                    <button type="submit"class="btn btn-danger btn-sm">Unassign</button>
                                                                                                </form>   
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                
                                                                        </table>    
                                                                    </div>

                                                                    <form method="POST" action="{{route('courses.assign', $course->course_id)}}">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="form-group row">
                                                                                <label for="email"
                                                                                    class="col-md-3 col-form-label text-md-right">Instructor
                                                                                    Email</label>

                                                                                <div class="col-md-7">
                                                                                    <input id="email" type="email"
                                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                                        name="email" autofocus>

                                                                                    @error('program')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <input type="hidden" class="form-input" name="program_id" value="{{$course->program_id}}">

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                    
                                                                            <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary col-2 btn-sm">Assign</button>
                                                                        </form>

                                                                        <form method="POST" action="{{route('courses.assign', $course->course_id)}}">
                                                                            @csrf
                                                                            <input id="self" type="hidden" class="form-control" name="email" value="{{Auth::User()->email}}">
                                                                            <input type="hidden" class="form-input" name="program_id" value={{$course->program_id}}>
                                                                            <button type="submit" style="width:120px" class="btn btn-outline-primary btn-sm" >Assign to Self</button>
                                                                        </form>
                                                                        </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </td>
                                                    
                                                </tr>

                                            @endforeach

                                        @endif
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-sm col-2 mt-2 float-right" data-toggle="modal" data-target="#createCourseModal">
                                ＋ Add Course
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createCourseModalLabel">Add Course</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ action('CourseController@store') }}">
                                    @csrf
                                    <div class="modal-body">


                                        <div class="form-group row">
                                            <label for="course_code"
                                                class="col-md-2 col-form-label text-md-right">Course Code</label>

                                                <div class="col-md-8">
                                                    <input id="course_code" type="text"
                                                        pattern="[A-Za-z]{4}"
                                                class="form-control @error('course_code') is-invalid @enderror" 
                                                        name="course_code" required autofocus>
                
                                                    @error('course_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <small id="helpBlock" class="form-text text-muted">
                                                        Four letter course code e.g. SUST, COSC etc.
                                                    </small>
                                                </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="course_num" class="col-md-2 col-form-label text-md-right">Course
                                                Number</label>

                                            <div class="col-md-8">
                                                <input id="course_num" type="number"
                                                    class="form-control @error('course_num') is-invalid @enderror"
                                                    name="course_num" required autofocus>

                                                @error('course_num')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="course_title"
                                                class="col-md-2 col-form-label text-md-right">Course Title</label>

                                            <div class="col-md-8">
                                                <input id="course_title" type="text"
                                                    class="form-control @error('course_title') is-invalid @enderror"
                                                    name="course_title" required autofocus>

                                                @error('course_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="required" class="col-md-2 col-form-label text-md-right">Required</label>
                                            <div class="col-md-6">
                            
                                              <div class="form-check ">
                                                <label class="form-check-label">
                                                  <input type="radio" class="form-check-input" name="required" value="1" >
                                                  Required
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <label class="form-check-label">
                                                  <input type="radio" class="form-check-input" name="required" value="-1">
                                                  Not Required
                                                </label>
                                              </div>
                                              <small class="form-text text-muted">
                                                Is this course required by the program?
                                            </small>   
                                            </div>
                                          </div>

                                        <input type="hidden" class="form-check-input" name="program_id"
                                            value={{$program->program_id}}>
                                        <input type="hidden" class="form-check-input" name="type" value="assigned">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary col-2 btn-sm"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="card-footer">
                    <a href="{{route('programWizard.step2', $program->program_id)}}"><button class="btn btn-sm btn-primary mt-3 col-3  float-left">⬅ Mapping Scale</button></a>
                    <a href="{{route('programWizard.step4', $program->program_id)}}"><button class="btn btn-sm btn-primary mt-3 col-3 float-right">Begin Mapping Program ➡</button></a>
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
  
      $("form").submit(function () {
        // prevent duplicate form submissions
        $(this).find(":submit").attr('disabled', 'disabled');
        $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  
      });
    });
  </script>
@endsection