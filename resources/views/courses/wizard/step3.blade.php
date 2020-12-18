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
                            <td><a class="btn btn-primary" href="{{route('courseWizard.step3', $course->course_id)}}"
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
                    <p class="form-text text-muted">Input all teaching and learning activities of the course individually.</p>

                    <div id="admins">
                        <div class="row">
                            <div class="col">
                                <table class="table table-borderless">

                                    @if(count($l_activities)<1) 
                                        <tr class="table-active">
                                            <th colspan="2">There are no teaching and learning activities set for this course.</th>
                                        </tr>


                                    @else

                                        <tr class="table-active">
                                            <th colspan="2">Teaching and Learning Activities</th>
                                        </tr>
                                       
                                            @foreach($l_activities as $l_activity)

                                            <tr>
                                                <td>{{$l_activity->l_activity}}</td>
                                                <td>
                                                    <form action="{{route('la.destroy', $l_activity->l_activity_id)}}" method="POST" class="float-right">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                        <button type="submit" style="width:60px;" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            @endforeach

                                        

                                    @endif
                                </table>
                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm col-3 mt-3 float-right" data-toggle="modal" data-target="#addActivityModal">
                        ＋ Add Teaching and Learning Activity
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog"
                        aria-labelledby="addActivityModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addActivityModalLabel">Add Teaching and Learning Activity
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" action="{{ action('LearningActivityController@store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="l_activity" class="col-md-5 col-form-label text-md-center">Teaching and Learning Activity</label>

                                            <div class="col-md-7">
                                                <input list="l_activities" id="l_activity" type="text" class="form-control @error('l_activity') is-invalid @enderror" name="l_activity" placeholder="Choose from the dropdown list or type your own" required autofocus>
                                                <datalist id="l_activities" >
                                                    <option value="Discussion">
                                                    <option value="Gallery walk">
                                                    <option value="Group discussion">
                                                    <option value="Group work">
                                                    <option value="Guest Speaker">
                                                    <option value="Independent study">
                                                    <option value="Issue-based inquiry">
                                                    <option value="Jigsaw">
                                                    <option value="Journals and learning logs">
                                                    <option value="Lab">
                                                    <option value="Lecture">
                                                    <option value="Literature response">
                                                    <option value="Mind map">
                                                    <option value="Poll">
                                                    <option value="Portfolio development">
                                                    <option value="Problem-solving">
                                                    <option value="Reflection piece">
                                                    <option value="Role-playing">
                                                    <option value="Service learning">
                                                    <option value="Seminar">
                                                    <option value="Sorting">
                                                    <option value="Think-pair-share">
                                                    <option value="Tutorial">
                                                    <option value="Venn diagram">
                                                   
                                                </datalist>

                                                @error('l_activity')
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
                    <a href="{{route('courseWizard.step2', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Student Assessment Methods</button>
                    </a>
                    <a href="{{route('courseWizard.step4', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Course Outcome Mapping ➡</button>
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