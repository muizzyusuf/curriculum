@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>{{$course->course_code}} - {{$course->course_title}}</h1>
            <h5>{{$program->program}} <br>{{$program->faculty}} <br>{{$program->level}} </h5>


            <div class="card">
                @if(count($l_outcomes)>0)
                @foreach($l_outcomes as $l_outcome)
                <table class="table table-borderless">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2" scope="col">Learning outcome </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">{{$l_outcome->l_outcome}}</th>
                            <th>
                                <form action="{{route('learningOutcomes.destroy', $l_outcome->l_outcome_id )}}" method="POST" class=" float-right">
                                    @csrf
                                    {{method_field('DELETE')}}
                                
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{route('learningOutcomes.edit', $l_outcome->l_outcome_id)}}"><button type="button" class="btn btn-light mr-2 float-right">Edit</button></a>
                                

                                
                            </th>
                            
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div class="card">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <th colspan="2" scope="col">
                                                Assessment Methods
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach($a_methods as $a_method)
                                            @if($a_method->l_outcome_id == $l_outcome->l_outcome_id)
                                            <tr>
                                                <td>
                                                    {{$a_method->assessment_method}}
                                                </td>
                                                <td>
                                                    <form action="{{route('assessmentMethods.destroy', $a_method->a_method_id )}}" method="POST" class=" float-right">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" class="form-check-input" name="program_id"
                                                        value={{$program->program_id}}>
                                                        <input type="hidden" class="form-check-input" name="course_code"
                                                        value={{$course->course_code}}>
                                
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                            @endif


                                            @endforeach
                                            <tr>
                                                <td colspan="2">
                                                    <div class="row">
                                                        <div class="col">
                                                            <button type="button"
                                                                class="btn btn-primary mt-2 mb-2 float-right"
                                                                data-toggle="modal" data-target="#createAMModal">
                                                                Add Assessment Method
                                                            </button>
                                                        </div>
                                                    </div>


                                                    <!-- Modal -->
                                                    <div class="modal fade" id="createAMModal" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Add
                                                                        Assessment
                                                                        Method</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="{{ action('AssessmentMethodController@store') }}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label for="l_activity"
                                                                                class="col-md-3 col-form-label text-md-right">Assessment
                                                                                Method</label>

                                                                            <div class="col-md-8">
                                                                                <select name="assessment_method"
                                                                                    class="custom-select">
                                                                                    <option selected>Select student
                                                                                        assessment method</option>
                                                                                    <option value="Exam">Exam</option>
                                                                                    <option value="Quiz">Quiz
                                                                                    </option>
                                                                                    <option value="Assignment">
                                                                                        Assignment</option>
                                                                                    <option value="Project">Project
                                                                                    </option>
                                                                                </select>

                                                                                @error('assessment_method')
                                                                                <span class="invalid-feedback"
                                                                                    role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" name="l_outcome_id"
                                                                            value={{$l_outcome->l_outcome_id}}>
                                                                        <input type="hidden" name="program_id"
                                                                            value={{$program->program_id}}>
                                                                        <input type="hidden" name="course_code"
                                                                            value={{$course->course_code}}>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Add</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <th colspan="2" scope="col">
                                                Learning Activities
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach($l_activities as $l_activity)
                                            @if($l_activity->l_outcome_id == $l_outcome->l_outcome_id)
                                            <tr>
                                                <td>
                                                    {{$l_activity->l_activity}}
                                                </td>
                                                <td>
                                                    <form action="{{route('learningActivities.destroy', $l_activity->l_activity_id )}}" method="POST" class=" float-right">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" class="form-check-input" name="program_id"
                                                        value={{$program->program_id}}>
                                                        <input type="hidden" class="form-check-input" name="course_code"
                                                        value={{$course->course_code}}>
                                
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                            @endif


                                            @endforeach
                                            <tr>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <button type="button"
                                                                class="btn btn-primary mt-2 mb-2 float-right"
                                                                data-toggle="modal" data-target="#createLAModal">
                                                                Add Learning Activity
                                                            </button>
                                                        </div>
                                                    </div>


                                                    <!-- Modal -->
                                                    <div class="modal fade" id="createLAModal" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Add
                                                                        Learning
                                                                        Activity</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="{{ action('LearningActivityController@store') }}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label for="l_activity"
                                                                                class="col-md-3 col-form-label text-md-right">Learning
                                                                                Activity</label>

                                                                            <div class="col-md-8">
                                                                                <select name="l_activity"
                                                                                    class="custom-select">
                                                                                    <option selected>Select student
                                                                                        learning
                                                                                        activity</option>
                                                                                    <option value="Lecture">lecture
                                                                                    </option>
                                                                                    <option value="Group work">Group
                                                                                        work
                                                                                    </option>
                                                                                    <option value="Lab">Lab</option>
                                                                                    <option value="Tutorial">Tutorial
                                                                                    </option>
                                                                                </select>

                                                                                @error('l_activity')
                                                                                <span class="invalid-feedback"
                                                                                    role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" name="l_outcome_id"
                                                                            value={{$l_outcome->l_outcome_id}}>
                                                                        <input type="hidden" name="program_id"
                                                                            value={{$program->program_id}}>
                                                                        <input type="hidden" name="course_code"
                                                                            value={{$course->course_code}}>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Add</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
                @endforeach

                @else

                <div class="card-header">
                    This course has no learning outcomes.
                </div>
                @endif

            </div>

            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary mt-2 float-right" data-toggle="modal"
                        data-target="#createLOModal">
                        Add Learning Outcome
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createLOModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Learning Outcome</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ action('LearningOutcomeController@store') }}">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group row">
                                    <label for="l_outcome" class="col-md-2 col-form-label text-md-right">Learning
                                        Outcome</label>

                                    <div class="col-md-8">
                                        <input id="l_outcome" type="text"
                                            class="form-control @error('l_outcome') is-invalid @enderror"
                                            name="l_outcome" required autofocus>

                                        @error('l_outcome')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="hidden" class="form-check-input" name="program_id"
                                    value={{$program->program_id}}>
                                <input type="hidden" class="form-check-input" name="course_code"
                                    value={{$course->course_code}}>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <form action="{{route('courses.map.save',  [$program->program_id, $course->course_code])}}" method="POST" class="mt-5 float-right">
                @csrf
    
                
                <input type="submit" class="btn btn-primary" name="save" value="Save Map">
                <input type="submit" class="btn btn-success" name="done" value="Done">
            </form>

            

        </div>
    </div>
</div>
@endsection