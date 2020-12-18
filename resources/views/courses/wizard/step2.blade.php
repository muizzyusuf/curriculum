@extends('layouts.app')

@section('content')

<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('courses.wizard.header')

            <!-- progress bar -->
            <div>
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tbody>
                        <tr>
                            <td><a class="btn @if($lo_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step1', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>1</b> </a></td>
                            <td><a class="btn btn-primary" href="{{route('courseWizard.step2', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>2</b> </a></td>
                            <td><a class="btn @if($la_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step3', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>3</b> </a></td>
                            <td><a class="btn @if($oAct < 1 && $oAss < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step4', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>4</b> </a></td>
                            <td><a class="btn @if($outcomeMaps < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step5', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>5</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step6', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>6</b> </a></td>
                        </tr>

                        <tr>
                            <td>Course Learning Outcomes</td>
                            <td>Student Assesment Methods</td>
                            <td>Teaching and Learning Activities</td>
                            <td>Course Outcome Mapping</td>
                            <td>Program Outcome Mapping</td>
                            <td>Course Summary</td>
                        </tr>
                    </tbody>
                </table>
            </div>






            <div class="card">

                <div class="card-body">
                    <p class="form-text text-muted">Input all <a href="https://ctlt.ubc.ca/resources/webliography/assessmentevaluation/" target="_blank">assessment methods</a> of the course individually.</p>

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
                                                                                    <option value="Annotated bibliography">
                                                                                    <option value="Assignment">
                                                                                    <option value="Attendance">
                                                                                    <option value="Brochure, poster">
                                                                                    <option value="Case analysis">
                                                                                    <option value="Debate">
                                                                                    <option value="Diagram/chart">
                                                                                    <option value="Dialogue">
                                                                                    <option value="Essay">
                                                                                    <option value="Exam">
                                                                                    <option value="Fill in the blank test">
                                                                                    <option value="Group discussion">
                                                                                    <option value="Lab/field notes">
                                                                                    <option value="Letter">
                                                                                    <option value="Literature review">
                                                                                    <option value="Mathematical problem">
                                                                                    <option value="Materials and methods plan">
                                                                                    <option value="Multimedia or slide presentation">
                                                                                    <option value="Multiple-choice test">
                                                                                    <option value="News or feature story">
                                                                                    <option value="Oral report">
                                                                                    <option value="Outline">
                                                                                    <option value="Participation">
                                                                                    <option value="Project">
                                                                                    <option value="Project plan">
                                                                                    <option value="Poem">
                                                                                    <option value="Play">
                                                                                    <option value="Quiz">
                                                                                    <option value="Research proposal">
                                                                                    <option value="Review of book, play, exhibit">
                                                                                    <option value="Rough draft or freewrite">
                                                                                    <option value="Social media post">
                                                                                    <option value="Summary">
                                                                                    <option value="Technical or scientific report">
                                                                                    <option value="Term/research paper">
                                                                                    <option value="Thesis statement">
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
                                            
                                                                            <div class="input-group col-md-8">
                                                                                <input id="weight" type="number"
                                                                                    class="form-control @error('weight') is-invalid @enderror" value="{{$a_method->weight}}" name="weight" min="1" max="100" required autofocus>
                                                                                
                                                                                <div class="input-group-append">
                                                                                    <div class="input-group-text">%</div>
                                                                                </div>
                                                                                
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
                                        
                                            <tr>
                                                <td><b>TOTAL</b></td>
                                                <td><b>{{$totalWeight}}%</b></td>
                                            </tr>

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
                                                
                                                <input list="a_methods1" id="a_method" type="text" class="form-control @error('a_method') is-invalid @enderror" name="a_method" placeholder="Choose from the dropdown list or type your own" required autofocus>

                                                <datalist id="a_methods1">
                                                    <option value="Annotated bibliography">
                                                    <option value="Assignment">
                                                    <option value="Attendance">
                                                    <option value="Brochure, poster">
                                                    <option value="Case analysis">
                                                    <option value="Debate">
                                                    <option value="Diagram/chart">
                                                    <option value="Dialogue">
                                                    <option value="Essay">
                                                    <option value="Exam">
                                                    <option value="Fill in the blank test">
                                                    <option value="Group discussion">
                                                    <option value="Lab/field notes">
                                                    <option value="Letter">
                                                    <option value="Literature review">
                                                    <option value="Mathematical problem">
                                                    <option value="Materials and methods plan">
                                                    <option value="Multimedia or slide presentation">
                                                    <option value="Multiple-choice test">
                                                    <option value="News or feature story">
                                                    <option value="Oral report">
                                                    <option value="Outline">
                                                    <option value="Participation">
                                                    <option value="Project">
                                                    <option value="Project plan">
                                                    <option value="Poem">
                                                    <option value="Play">
                                                    <option value="Quiz">
                                                    <option value="Research proposal">
                                                    <option value="Review of book, play, exhibit">
                                                    <option value="Rough draft or freewrite">
                                                    <option value="Social media post">
                                                    <option value="Summary">
                                                    <option value="Technical or scientific report">
                                                    <option value="Term/research paper">
                                                    <option value="Thesis statement">
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
            
                                            <div class="input-group col-md-8">
                                                <input id="weight" type="number" step=".01"
                                                    class="form-control @error('weight') is-invalid @enderror" name="weight" min="1" max="100" required autofocus>

                                                <div class="input-group-append">
                                                    <div class="input-group-text">%</div>
                                                </div>
            
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