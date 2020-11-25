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
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step5', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>5</b> </a></td>
                            <td><a class="btn btn-success" href="{{route('courseWizard.step6', $course->course_id)}}"
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

            <div class="card ">

                <a href="{{route('courses.pdf', $course->course_id)}}">
                    <button class="btn btn-sm btn-primary mt-3 mb-3 col-3 float-right mr-5"> Download PDF ⭳ </button>
                </a>

                <p class="ml-5 mr-5 form-text text-muted">You	can	review	and	download	the	answers	you	entered	during	the	process	of	mapping	
                    the	course.	Based	on	this	review,	you	might	want	to	revisit	some	steps	and	edit	the	
                    information	you	supplied.
                    You	can	also	proceed to the next section and submit	your	summary	to	complete	the	mapping	of	your	course.</p>



                <div class="card ml-5 mr-5 mt-3 mb-5">

                    
                    <div class="card-header font-weight-bold">
                        Course Learning Outcomes for {{$course->course_code}}{{$course->course_num}}
                    </div>
                    
    
                    <div class="card-body ml-5 mr-5">
                        The course learning outcomes used in this course are listed below.
                        <table class="table table-bordered table-sm  mt-3">
    
                            @if(count($l_outcomes)<1) 
                                <tr>
                                    <th class="table-light">There are no course learning outcomes set for this course.</th>
                                </tr>
    
                            @else
    
                                <tr>
                                    <th class="table-light"></th>
                                    <th class="table-light">Course Learning Outcomes</th>
                                </tr>
                                    @for($i = 0; $i < count($l_outcomes); $i++)                               
                                        <tr>
                                            <td style="width:5%" >{{$i+1}}</td>
                                            <td>
                                                <b>{{$l_outcomes[$i]->clo_shortphrase}}</b><br>
                                                {{$l_outcomes[$i]->l_outcome}}
                                            
                                            </td>
                                        </tr>
                                    @endfor
    
                            @endif
    
                        </table>   
    
                    </div>
                
                    <div class="card-header font-weight-bold">
                        Student Assessment Methods for {{$course->course_code}}{{$course->course_num}}
                    </div>
                    
    
                    <div class="card-body ml-5 mr-5">
                        Student assessment methods used in this course are listed below.
                        <table class="table table-bordered table-sm  mt-3">
    
                            @if(count($a_methods)<1) 
                                <tr>
                                    <th class="table-light">There are no student assessment methods set for this course.</th>
                                </tr>
    
                            @else
    
                                <tr>
                                    <th class="table-light"></th>
                                    <th class="table-light">Student Assesment Methods</th>
                                    <th class="table-light">Weight</th>
                                </tr>
                                    @for($i = 0; $i < count($a_methods); $i++)                               
                                        <tr>
                                            <td style="width:5%" >{{$i+1}}</td>
                                            <td>{{$a_methods[$i]->a_method}}</td>
                                            <td>{{$a_methods[$i]->weight}}%</td>
                                        </tr>
                                    @endfor
    
                            @endif
    
                        </table>   
    
                    </div>
    
                    <div class="card-header font-weight-bold">
                        Teaching and Learning Activities for {{$course->course_code}}{{$course->course_num}}
                    </div>
    
    
                    <div class="card-body ml-5 mr-5">
                        Teaching and Learning Activities description goes here.
    
                        <table class="table table-bordered table-sm mt-3">
    
                            @if(count($l_activities)<1) 
                                <tr>
                                    <th>There are no teaching and learning activities set for this course.</th>
                                </tr>
    
    
                            @else
    
                                <tr>
                                    <th class="table-light"></th>
                                    <th class="table-light">Teaching and Learning Activities</th>
                                </tr>
                                @for($i=0; $i<count($l_activities); $i++)
    
                                    <tr>
                                        <td style="width:5%" >{{$i+1}}</td>
                                        <td>{{$l_activities[$i]->l_activity}}</td>
                                    </tr>
    
                                @endfor
    
                            @endif
                        </table>
    
                    </div>
    
                    <div class="card-header font-weight-bold">
                        Mapping of {{$course->course_code}}{{$course->course_num}} CLOs to Teaching and Learning Activities & Assessment Methods 
                    </div>
    
    
                    <div class="card-body ml-5 mr-5">
                        By the end of the course, students are expected to learn the following outcomes.
                        <table class="table table-bordered table-sm mt-3">
    
                            @if(count($l_outcomes)<1) 
                                <tr>
                                    <th class="table-light">There are no course learning outcomes set for this course.</th>
                                </tr>
    
                            @else
    
                                <tr>
                                    <th class="table-light"></th>
                                    <th class="table-light">Course Learning Outcomes</th>
                                    <th class="table-light">Student Assessment Method</th>
                                    <th class="table-light">Teaching and Learning Activity</th>
                                </tr>
                                    @for($i = 0; $i < count($l_outcomes); $i++)                               
                                        <tr>
                                            <td style="width:5%" >{{$i+1}}</td>
                                            <td>{{$l_outcomes[$i]->l_outcome}}</td>
                                            <td>
                                                @foreach($outcomeAssessments as $oa)
                                                    @if($oa->l_outcome_id == $l_outcomes[$i]->l_outcome_id )
                                                        {{$oa->a_method}}<br>
    
                                                    @endif
    
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($outcomeActivities as $oa)
                                                    @if($oa->l_outcome_id == $l_outcomes[$i]->l_outcome_id )
                                                        {{$oa->l_activity}}<br>
    
                                                    @endif
    
                                                @endforeach
    
                                            </td>
                                        </tr>
                                    @endfor
    
                            @endif
    
                        </table>   
    
                    </div>
    
                    <div class="card-header font-weight-bold">
                        Program Learning Outcomes for: {{$program->program}}
                    </div>
    
                    <div class="card-body ml-5 mr-5 mt-3">
    
                        Program learning outcomes are listed below.
    
                        <table class="table table-bordered table-sm mt-3">
    
                            @if(count($pl_outcomes)<1) 
                                <tr>
                                    <th class="table-light">There are no program learning outcomes set for this course.</th>
                                </tr>
    
                            @else
    
                                <tr>
                                    <th class="table-light"></th>
                                    <th class="table-light">Program Learning Outcomes</th>
                                    @if(count($ploCategories)>0)
                                        <th class="table-light">PLO Category</th>
                                    @endif
                                </tr>
                                    @for($i = 0; $i < count($pl_outcomes); $i++)                               
                                        <tr>
                                            <td style="width:5%" >{{$i+1}}</td>
                                            <td>
                                                <b>{{$pl_outcomes[$i]->plo_shortphrase}}</b><br>
                                                {{$pl_outcomes[$i]->pl_outcome}}
                                            
                                            </td>
                                            @if(count($ploCategories)>0)
                                                @if(isset($pl_outcomes[$i]->category->plo_category))
                                                    <td>{{$pl_outcomes[$i]->category->plo_category}}</td>
                                                @else
                                                    <td>Uncategorised</td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endfor
    
                            @endif
    
                        </table>   
    
                    </div>
                    
    
                    <div class="card-header font-weight-bold">
                        Mapping of CLOs to PLOs for {{$course->course_code}}{{$course->course_num}}
                    </div>
    
    
                    <div class="card-body ml-5 mr-5">
                        
                        @if(count($mappingScales)>0)
                            The following are the mapping scale levels used to indicate the degree to which a program-level learning outcome is addressed by a particular course outcome.
                        
                            <div class="container row mt-3 mb-2">
                                <div class="col">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Mapping Scale</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mappingScales as $ms)
                                                
                                                <tr>
                                                    
                                                    <td>
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
                                </div>
                            </div>
                        @else
                            
                            <table class="table table-bordered table-sm">   
                                <tr>
                                    <th class="table-light">There are no mapping scale levels set for this program.</th>
                                </tr>
                            </table> 

                        @endif
    
                        This chart shows the alignment of course outcomes to program-level learning outcomes. Program-level learning outcomes and the mapping scale are listed below the chart.
    
                        <table  class="table table-bordered table-sm mt-3">
    
                            @if(count($outcomeMaps)<1) 
                                <tr>
                                    <th  class="table-light">Course learning outcomes have not been mapped to program learning outcomes for this course.</th>
                                </tr>
    
                            @else
    
                                <tr>
                                    <th  class="table-light">Course Outcomes</th>
                                    <th  class="table-light"colspan="{{count($pl_outcomes)}}">Program Learning Outcomes</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    @for($i = 0; $i < count($pl_outcomes); $i++)                               
                                    
                                        <td style="height:0; vertical-align: bottom; text-align: left;">
                                            <span style="writing-mode: vertical-rl; transform: rotate(180deg);">
                                                @if(isset($pl_outcomes[$i]->plo_shortphrase))
                                                    {{$i+1}}.<br>
                                                    {{$pl_outcomes[$i]->plo_shortphrase}}
                                                @else 
                                                    PLO {{$i+1}}
                                                @endif
                                                
                                            </span>
                                        </td>
                                    
                                    @endfor
                                </tr>
                                
                                @for($i = 0; $i < count($l_outcomes); $i++)                               
                                    
                                    <tr>
                                    
                                        <td style="max-width:0; height: 50px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" >
                                            @if(isset($l_outcomes[$i]->clo_shortphrase))
                                                {{$i+1}}. {{$l_outcomes[$i]->clo_shortphrase}}
                                            @else 
                                                CLO {{$i+1}}
                                            @endif
                                        </td>

                                        @for($j = 0; $j < count($pl_outcomes); $j++)
                                            @foreach ($outcomeMaps as $om)
                                                @if( $om->pl_outcome_id == $pl_outcomes[$j]->pl_outcome_id && $om->l_outcome_id == $l_outcomes[$i]->l_outcome_id )
                                                    <td @foreach($mappingScales as $ms) @if($ms->abbreviation == $om->map_scale_value) style="background-color:{{$ms->colour}}" @endif @endforeach class="text-center align-middle" >{{$om->map_scale_value}}</td>

                                                @endif
                                            @endforeach

                                        @endfor
                                    </tr>
                                @endfor
    
                            @endif
    
                        </table>   
    
                    </div>
    
                </div>
            

                <div class="card-footer">
                    <a href="{{route('courseWizard.step5', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Course Outcomes Mapping</button>
                    </a>
                    <a href="{{route('courseWizard.step7', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right"> Finish  ➡</button>
                    </a>
                    
                </div>

            </div>  

        </div>

            



    </div>



</div>




@endsection