@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mt-2 mb-3">
                <h3>Course: {{$course->course_code}}{{$course->course_num}}</h3>
                <h5>{{$course->course_title}}</h5>

            </div>

            <div class="alert alert-warning" role="alert">
                ⚠️ Please complete the steps below to map this course!
              </div>

            <!-- progress bar -->
            <div>
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tbody>
                        <tr>
                            <td><a class="btn btn-success" href="{{route('courseWizard.step0', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>0</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step1', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>1</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step2', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>2</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step3', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>3</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step4', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>4</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step5', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>5</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step6', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>6</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step7', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>7</b></a></td>
                        </tr>

                        <tr>
                            <td>General Information</td>
                            <td>Course Learning Outcomes</td>
                            <td>Student Assesment Methods</td>
                            <td>Teaching and Learning Activities</td>
                            <td>Course Outcome Mapping</td>
                            <td>Program Outcome Mapping</td>
                            <td>Course Summary</td>
                            <td>Finish</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="card">

                <div class="card-body">
    

                    <div class="row mb-5">
                        <div class="col">
                            <form action="{{route('courses.destroy', $course->course_id)}}" method="POST"
                                class="float-right ml-2">
                                @csrf
                                {{method_field('DELETE')}}
                                <input type="hidden" class="form-check-input " name="program_id"
                                    value={{$course->program_id}}>

                                <button type="submit" style="width:200px" class="btn btn-danger btn-sm">Delete Course</button>
                            </form>
                        </div>

                        <div class="col">
                            <!-- Assign instructor button  -->
                            <button type="button" class="btn btn-outline-primary btn-sm ml-2 float-left" style="width:200px"
                                data-toggle="modal" data-target="#assignInstructorModal">Collaborators</button>

                            <!-- Modal -->
                            <div class="modal fade" id="assignInstructorModal" tabindex="-1" role="dialog"
                                aria-labelledby="assignInstructorModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="assignInstructorModalLabel">Assign Instructor to
                                                Course</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                @if(count($courseUsers)<1) <tr class="table-active">
                                                    <th colspan="2">There are no instructors assigned to this course.
                                                    </th>
                                                    </tr>

                                                    @elseif(count($courseUsers)==1)
                                                    <tr class="table-active">
                                                        <th colspan="2">You are the only instructor assigned to this
                                                            course.
                                                        </th>
                                                    </tr>

                                                    @else

                                                    <tr class="table-active">
                                                        <th colspan="2">Instructor</th>
                                                    </tr>
                                                    <div class="card-body">
                                                        @foreach($courseUsers as $instructor)
                                                        <tr>
                                                            <td>{{$instructor->email}}</td>
                                                            <td>
                                                                <form
                                                                    action="{{route('courses.unassign', $course->course_id)}}"
                                                                    method="POST" class="float-right ml-2">
                                                                    @csrf
                                                                    {{method_field('DELETE')}}
                                                                    <input type="hidden" class="form-check-input"
                                                                        name="program_id"
                                                                        value="{{$course->program_id}}">
                                                                    <input type="hidden" class="form-check-input"
                                                                        name="email" value="{{$instructor->email}}">
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Unassign</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </div>

                                                    @endif
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
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <input type="hidden" class="form-input" name="program_id"
                                                    value="{{$course->program_id}}">

                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary col-2 btn-sm"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit"
                                                    class="btn btn-primary col-2 btn-sm">Assign</button>
                                            </div>
                                        </form>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>


                    <form method="POST" action="{{ action('CourseController@update', $course->course_id) }}">
                        @csrf
                        {{method_field('PUT')}}

                        <div class="modal-body">


                            <div class="form-group row">
                                <label for="course_code" class="col-md-2 col-form-label text-md-right">Course
                                    Code</label>

                                <div class="col-md-8">
                                    <input id="course_code" type="text"
                                        class="form-control @error('course_code') is-invalid @enderror"
                                        name="course_code" value="{{$course->course_code}}" required autofocus>

                                    @error('course_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_num" class="col-md-2 col-form-label text-md-right">Course
                                    Number</label>

                                <div class="col-md-8">
                                    <input id="course_num" type="number"
                                        class="form-control @error('course_num') is-invalid @enderror" name="course_num"
                                        value="{{$course->course_num}}" required autofocus>

                                    @error('course_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_title" class="col-md-2 col-form-label text-md-right">Course
                                    Title</label>

                                <div class="col-md-8">
                                    <input id="course_title" type="text"
                                        class="form-control @error('course_title') is-invalid @enderror"
                                        name="course_title" value="{{$course->course_title}}" required autofocus>

                                    @error('course_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary col-2 btn-sm float-right">Save</button>

                    </form>

                </div>


                <div class="card-footer">

                    <a href="{{route('courseWizard.step1', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right"> Course Learning Outcomes
                            ➡</button>
                    </a>

                </div>

            </div>

        </div>





    </div>



</div>




@endsection