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
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step2', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>2</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step3', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>3</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step4', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>4</b> </a></td>
                            <td><a class="btn btn-success" href="{{route('courseWizard.step5', $course->course_id)}}"
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
                    <p class="form-text text-muted">On	this	page,	you	can	use	the	mapping	scale	to	indicate	the	level	of	alignment	of	each	course	
                        outcome	with	each	program-level	learning	outcome	(if	any). If	the	course	outcome	does	not	align, leave	the	level	of	alignment	at	NA	(No	
                        Alignment)</p>
                    <p class="form-text text-muted">Note:		Remember to click save once you are done.</p>

                    <div class="container row">
                        <div class="col">
                            @if(count($mappingScales)>0)
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th colspan="2">Mapping Scale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mappingScales as $ms)
                                            
                                        <tr>
                                                
                                            <td style="width:20%">
                                                <div style="background-color:{{$ms->colour}}; height: 10px; width: 10px;"></div>
                                                {{$ms->title}}<br>
                                                ({{$ms->abbreviation}})
                                            </td>
                                            <td>
                                                {{$ms->description}}
                                            </td>
                                            
                                        </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            @else
                            <table class="table table-bordered table-sm">   
                                <tr>
                                    <th class="table-light">There are no mapping scale levels set for this program.</th>
                                </tr>
                            </table> 

                            @endif
                        </div>
                    </div>


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
                                    <form action="{{action('OutcomeMapController@store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">

                                        @for($i = 0; $i < count($l_outcomes); $i++) 
                                            <div class="card mb-3">

                                                

                                                <div class="card-body">

                                                    <div class="mb-2">
                                                        <b>Course Learning Outcome #{{$i+1}}</b><br>
                                                        {{$l_outcomes[$i]->l_outcome}}
                                                    </div>

                                                    <table class="table table-sm">
                                                        <thead class="thead-light">
                                                            <tr class="table-active">
                                                                <th>Program Learning Outcome(s)</th>
                                                                @foreach($mappingScales as $ms)  
                                                                    <th>
                                                                        {{$ms->abbreviation}}
                                                                    </th>
                                                                @endforeach
                                                                <th>N/A</th>
                                                            </tr>
                                                            
                                                        </thead>
                                                        <tbody>
                                                            @foreach($pl_outcomes as $pl_outcome) 
                                                                <tr>
                                                                    <td>
                                                                        <b>{{$pl_outcome->plo_shortphrase}}</b><br>
                                                                            {{$pl_outcome->pl_outcome}}
                                                                    </td>
                                                                    @foreach($mappingScales as $ms)  
                                                                        <td>
                                                                        
                                                                            <div class="form-check">
                                                                                <input class="form-check-input position-static" type="radio" name="map[{{$l_outcomes[$i]->l_outcome_id}}][{{$pl_outcome->pl_outcome_id}}]" value="{{$ms->abbreviation}}"  
                                                                                @if(isset($l_outcomes[$i]->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot)) @if($l_outcomes[$i]->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot->map_scale_value == $ms->abbreviation) checked=checked @endif @endif>
                                                                            </div>
                                                                        </td>
                                                                    @endforeach

                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input position-static" type="radio" name="map[{{$l_outcomes[$i]->l_outcome_id}}][{{$pl_outcome->pl_outcome_id}}]" value="N/A"  
                                                                            @if(isset($l_outcomes[$i]->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot)) @if($l_outcomes[$i]->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot->map_scale_value =='N/A') checked=checked @endif @endif required>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>   
                                                    </table>
                                                </div>
                                            </div>
                                        @endfor

                                        <button type="submit" class="btn btn-primary btn-sm float-right col-2">Save</button>

                                    </form>    
                                </div>
                                    
                            @endif       
                        </div>

                    </div>

                        

                </div>
                <div class="card-footer">
                    <a href="{{route('courseWizard.step4', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Course Outcome Details</button>
                    </a>
                    <a href="{{route('courseWizard.step6', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Course Summary ➡</button>
                    </a>
                </div>

            </div>

                

        </div>

            



    </div>



</div>




@endsection