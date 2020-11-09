@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#settings" role="tab"
                        aria-controls="home" aria-selected="true">Program Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#plo" role="tab"
                        aria-controls="profile" aria-selected="false">Program Level Outcomes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#courses" role="tab"
                        aria-controls="contact" aria-selected="false">Courses</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="home-tab"><br> \\TO-DO:
                    Edit program information, Add or delete a program admin, delete a program etc. </div>
                <div class="tab-pane fade" id="plo" role="tabpanel" aria-labelledby="profile-tab"> <br>\\TO-DO: Add,
                    edit or delete a PLO </div>
                <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="contact-tab">
                    <h1>Courses</h1>
                    <div class="card">
                        @if(count($courses)>0)
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Course</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <td>{{$course->course_code}} - {{$course->course_title}} </td>
                                    <td> {{$program->program}} <br>{{$program->faculty}} <br> {{$program->level}} </td>
                                    <td> 

                                        <a href="{{route('courses.edit', [$course->course_code, $program->program_id])}}"><button type="button" class="btn btn-light mr-2 float-left">Edit</button></a>
                                        <a href="{{route('courses.instructor', [$course->course_code, $program->program_id])}}"><button type="button" class="btn btn-dark float-left">Assign</button></a>

                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>

                        @else
                        <div class="card">
                            <div class="card-header">
                                No courses have been added to this program
                            </div>

                        </div>


                        @endif

                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary mt-2 float-right" data-toggle="modal"
                                data-target="#createCourseModal">
                                Add Course
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ action('CourseController@store') }}">
                                    @csrf
                                    <div class="modal-body">


                                        <div class="form-group row">
                                            <label for="course_code" class="col-md-2 col-form-label text-md-right">Course Code</label>

                                            <div class="col-md-8">
                                                <input id="course_code" type="text"
                                                    class="form-control @error('program') is-invalid @enderror"
                                                    name="course_code" required autofocus>

                                                @error('program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="course_title" class="col-md-2 col-form-label text-md-right">Course Title</label>

                                            <div class="col-md-8">
                                                <input id="course_title" type="text"
                                                    class="form-control @error('program') is-invalid @enderror"
                                                    name="course_title" required autofocus>

                                                @error('program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <input type="hidden" class="form-check-input" name="program_id"
                                            value={{$program->program_id}}>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    


                </div>
            </div>


        </div>
    </div>
</div>
@endsection