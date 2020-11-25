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
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step0', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>0</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step1', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>1</b> </a></td>
                            <td><a class="btn btn-success" href="{{route('courseWizard.step2', $course->course_id)}}"
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
                    <p class="form-text text-muted">On	this	page,	you	can	add,	edit	or	delete	student	assessment	methods	that	you	use	in	your	
                        course.</p>

                    <div id="admins">
                        <div class="row">
                            <div class="col">
                                <table class="table table-borderless">

                                    @if(count($a_methods)<1) 
                                        <tr class="table-active">
                                            <th colspan="3">There are no student assessment methods set for this course.</th>
                                        </tr>


                                    @else

                                        <tr class="table-active">
                                            <th colspan="3">Student Assesment Methods</th>
                                        </tr>
                                       
                                            @foreach($a_methods as $a_method)

                                            <tr>
                                                <td>{{$a_method->a_method}}</td>
                                                <td>{{$a_method->weight}}%</td>
                                                <td>
                                                    <form action="{{route('am.destroy', $a_method->a_method_id)}}" method="POST" class="float-right ml-2">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                        <button type="submit" style="width:60px;" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>

                                                    <button type="button" style="width:60px;" class="btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#editAssessmentModal{{$a_method->a_method_id}}">
                                                        Edit
                                                    </button>
                                
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editAssessmentModal{{$a_method->a_method_id}}" tabindex="-1" role="dialog"
                                                        aria-labelledby="editAssessmentModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editAssessmentModalLabel">Edit Student Assessment Method
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                
                                                                <form method="POST" action="{{ route('am.update', $a_method->a_method_id) }}">
                                                                    @csrf
                                                                    {{method_field('PUT')}}
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label for="a_method" class="col-md-3 col-form-label text-md-right">Assessment Method</label>
                                
                                                                            <div class="col-md-8">
                                                                            <input list="a_methods" id="a_method" type="text" class="form-control @error('a_method') is-invalid @enderror" value="{{$a_method->a_method}}" name="a_method" required autofocus>
                                
                                                                                <datalist id="a_methods">
                                                                                    <option value="Exam">Exam</option>
                                                                                    <option value="Quiz">Quiz</option>
                                                                                    <option value="Assignment">Assignment</option>
                                                                                    <option value="Project">Project</option>
                                                                                </datalist>
                                
                                                                                @error('a_method')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                
                                                                        <div class="form-group row">
                                                                            <label for="weight" class="col-md-3 col-form-label text-md-right">Weight</label>
                                            
                                                                            <div class="col-md-8">
                                                                                <input id="weight" type="number"
                                                                                    class="form-control @error('weight') is-invalid @enderror" value="{{$a_method->weight}}" name="weight" min="1" max="100" required autofocus>
                                            
                                                                                @error('weight')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                
                                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                                                    </div>
                                                                </form>
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

                    <button type="button" class="btn btn-primary btn-sm col-3 mt-3 float-right" data-toggle="modal" data-target="#addAssessmentModal">
                        ＋ Add Student Assessment Method
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addAssessmentModal" tabindex="-1" role="dialog"
                        aria-labelledby="addAssessmentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addAssessmentModalLabel">Add Student Assessment Method
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" action="{{ action('AssessmentMethodController@store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="a_method" class="col-md-3 col-form-label text-md-right">Assessment Method</label>

                                            <div class="col-md-8">
                                                <input list="a_methods" id="a_method" type="text" class="form-control @error('a_method') is-invalid @enderror" name="a_method" required autofocus>

                                                <datalist id="a_methods">
                                                    <option value="Exam">Exam</option>
                                                    <option value="Quiz">Quiz</option>
                                                    <option value="Assignment">Assignment</option>
                                                    <option value="Project">Project</option>
                                                </datalist>

                                                @error('a_method')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="weight" class="col-md-3 col-form-label text-md-right">Weight</label>
            
                                            <div class="col-md-8">
                                                <input id="weight" type="number"
                                                    class="form-control @error('weight') is-invalid @enderror" name="weight" min="1" max="100" required autofocus>
            
                                                @error('weight')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{route('courseWizard.step1', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Course Learning Outcomes</button>
                    </a>
                    <a href="{{route('courseWizard.step3', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Teaching and Learning Activities ➡</button>
                    </a>
                </div>


            </div>
        </div>










    </div>
</div>
</div>
</div>
@endsection