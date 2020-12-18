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
                            <td><a class="btn @if($am_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step2', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>2</b> </a></td>
                            <td><a class="btn @if($la_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step3', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>3</b> </a></td>
                            <td><a class="btn btn-primary" href="{{route('courseWizard.step4', $course->course_id)}}"
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

                        <div class="row">
                            <div class="col">


                                @if(count($l_outcomes)<1) 
                                    <table class="table table-borderless">
                                        <tr class="table-active">
                                            <th colspan="2">There are no course learning outcomes set for this course.</th>
                                        </tr>
                                    </table>

                                @else

                                    


                                    <div class="card mt-1">
                                        @if(count($l_activities)<1 && count($a_methods)<1) 
                                            <table class="table table-borderless">
                                                <tr class="table-active">
                                                    <th colspan="2">There are no teaching/learning activities and assessment methods set for
                                                    this course</th>
                                                </tr>
                                            </table>
                                        @else 
                                            
                                                
                                            <div class="card-body">
                                                <div class="container mb-3">
                                                    <p class="form-text text-muted">This section is key for the exercise of mapping a course, from a constructive alignment perspective.
                                                    Carefully review the Course Learning Outcomes/Competencies you have identified, and take the time to select the assessment methods and teaching and learning activities that align with each of them.</p>
                                                    <span class="form-text text-primary font-weight-bold">Note: Remember to click save once you are done. </span>

                                                </div>

                                                <form id="outcomeDetails" action="{{route('courses.outcomeDetails', $course->course_id)}}" method="POST">
                                                    @csrf

                                                    <table class="table table-bordered" style="table-layout: fixed; width: 100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Course Learning Outcomes or Comptencies</th>
                                                                <th>Student Assessment Methods</th>
                                                                <th>Teaching and Learning Activities</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for($i = 0; $i < count($l_outcomes); $i++) 
                                                                <tr>
                                                                    
                                                                    <td scope="row"><b>{{$i+1}} .</b> {{$l_outcomes[$i]->l_outcome}}</td>
                                                                    <td>
                                                                        @foreach ($a_methods as $a_method)
                                                                            <div class="form-check form-check-inline">
                                                                                <label class="form-check-label">
                                                                                <input type="checkbox" class="form-check-input" name="a_methods[{{$l_outcomes[$i]->l_outcome_id}}][]" value="{{$a_method->a_method_id}}"  @if($l_outcomes[$i]->assessmentMethods->contains($a_method->a_method_id)) checked=checked @endif>
                                                                                {{$a_method->a_method}}
                                                            
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($l_activities as $l_activity)
                                                                            <div class="form-check form-check-inline">
                                                                                <label class="form-check-label">
                                                                                <input type="checkbox" class="form-check-input" name="l_activities[{{$l_outcomes[$i]->l_outcome_id}}][]" value="{{$l_activity->l_activity_id}}"  @if($l_outcomes[$i]->learningActivities->contains($l_activity->l_activity_id)) checked=checked @endif>
                                                                                {{$l_activity->l_activity}}
                                                            
                                                                                </label>
                                                                            </div>
                                                                            @endforeach
                                                                    </td>
                                                                    
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                
                                                    <button type="submit" class="btn btn-primary btn-sm float-right col-2">Save</button>

                                                </form>
                                            </div>
                                                
                                            
                                        @endif
                                    </div>
                                    

                                @endif
                                    
                            </div>
                            

                        </div>

                </div>

                <div class="card-footer">
                    <a href="{{route('courseWizard.step3', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Teaching and Learning Activities</button>
                    </a>
                    <a href="{{route('courseWizard.step5', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Program Outcome Mapping ➡</button>
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