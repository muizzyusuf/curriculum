@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">



        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary btn-sm col-2 mt-2 float-right" data-toggle="modal"
                    data-target="#createCourseModal">
                    ＋ Add Course
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog"
            aria-labelledby="createCourseModalLabel" aria-hidden="true">
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
                                <label for="course_code" class="col-md-3 col-form-label text-md-right">Course
                                    Code</label>

                                <div class="col-md-8">
                                    <input id="course_code" type="text"
                                        class="form-control @error('course_code') is-invalid @enderror"
                                        name="course_code" required autofocus>

                                    @error('course_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_num" class="col-md-3 col-form-label text-md-right">Course
                                    Number</label>

                                <div class="col-md-8">
                                    <input id="course_num" type="number"
                                        class="form-control @error('course_num') is-invalid @enderror" name="course_num"
                                        required autofocus>

                                    @error('course_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_title" class="col-md-3 col-form-label text-md-right">Course
                                    Title</label>

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
                                <label for="program_id" class="col-md-3 col-form-label text-md-right">Ministry of
                                    Advanced Education
                                    Standards</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="program_id" id="program_id" required>
                                        <option value="" disabled selected hidden>Please Choose...</option>
                                        <option value="1">Bachelor's degree level standards</option>
                                        <option value="2">Master's degree level standards</option>
                                        <option value="3">Doctoral degeree level standards</option>
                                    </select>
                                    <small id="helpBlock" class="form-text text-muted">
                                        Choose what Ministry of Advanced Education degree level standards to map your
                                        course to
                                    </small>
                                </div>
                            </div>

                        </div>


                        <input type="hidden" class="form-check-input" name="user_id" value={{Auth::id()}}>
                        <input type="hidden" class="form-check-input" name="type" value="unassigned">

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
</div>

<div class="card mb-5 mt-5">
    <div class="card-header">
        <b>Active Courses</b>
    </div>
    @if(count($activeCourses)>0)


    <div class="card-body">

        <div class="row mb-3">
            <div class="col">
                This list shows courses that you have created to map or been assigned to map as part of a program. From
                this list, you can choose the course you want to map.
            </div>
        </div>

        <table class="table">
            <tbody>
                @foreach($activeCourses as $course)
                <tr class="border">
                    <td><a href="{{route('courseWizard.step0', $course->course_id)}}">{{$course->course_code}}{{$course->course_num}}
                            - {{$course->course_title}} </a></td>
                    <td>{{$course->program}} <br>{{$course->faculty}} <br>{{$course->department}} <br> {{$course->level}} </td>
                    <td>❗In Progress</td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @else

    <div class="card-body">
        <div class="row">
            <div class="col">
                You have no active courses.
            </div>
        </div>
    </div>




    @endif

</div>

<div class="card mb-5">
    <div class="card-header">
        <b>Completed Courses</b>
    </div>
    @if(count($archivedCourses)>0)


    <div class="card-body">

        <div class="row mb-3">
            <div class="col">
                This list shows courses that you have mapped in previous years. From this list, you can choose the
                course you want to review.
            </div>
        </div>

        <table class="table">
            <tbody>
                @foreach($archivedCourses as $course)
                <tr class="border">
                    <td>{{$course->course_code}}{{$course->course_num}} - {{$course->course_title}}</td>
                    <td>{{$course->program}} <br>{{$course->faculty}} <br> {{$course->level}} </td>
                    
                    <td>
                        <a class="btn btn-secondary btn-sm" style="width:60px"
                            href="{{route('courses.edit', $course->course_id)}}" role="button">Edit</a>
                        <a class="btn btn-outline-secondary btn-sm" style="width:60px"
                            href="{{route('courses.summary', $course->course_id)}}" role="button">View</a>
                    </td>
                    <td>✔️Completed</td>



                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @else

    <div class="card-body">
        <div class="row">
            <div class="col">
                You have no completed courses.
            </div>
        </div>
    </div>




    @endif



</div>
</div>
</div>
@endsection