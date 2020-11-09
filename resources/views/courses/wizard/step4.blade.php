@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mt-2 mb-3">
                <h3>Course: {{$course->course_code}}{{$course->course_num}}</h3>
                <h5>{{$course->course_title}}</h5>

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
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step2', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>2</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step3', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>3</b> </a></td>
                            <td><a class="btn btn-success" href="{{route('courseWizard.step4', $course->course_id)}}"
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

                        <div class="row">
                            <div class="col">


                                @if(count($l_outcomes)<1) 
                                    <table class="table table-borderless">
                                        <tr class="table-active">
                                            <th colspan="2">There are no course learning outcomes set for this course.</th>
                                        </tr>
                                    </table>

                                @else

                                    <div class="jumbotron">

                                        <div class="card mt-5">
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
                                                            Select those student assessment methods (if any) as well as teaching and learning activities (if any) that you use in assessing as well as teaching	the course learning outcome.
                                                            If one of the two columns has not been set, you will have no options to select from. 
                                                        </div>

                                                        <form action="{{route('courses.outcomeDetails', $course->course_id)}}" method="POST">
                                                            @csrf

                                                            <table class="table table-bordered" style="table-layout: fixed; width: 100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Course Learning Outcomes</th>
                                                                        <th>Student Assessment Methods</th>
                                                                        <th>Teaching and Learning Activities</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @for($i = 0; $i < count($l_outcomes); $i++) 
                                                                        <tr >
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
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Course Outcome Mapping ➡</button>
                    </a>
                </div>



            </div>

            

        </div>
    </div>


</div>


@endsection