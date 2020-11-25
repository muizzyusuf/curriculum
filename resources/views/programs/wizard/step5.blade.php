@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mt-2 mb-3">
                <h3>Program Project: {{$program->program}}</h3>
                <h5>{{$program->faculty}}</h5>
                <h6>{{$program->department}}</h6>
                <h6 class="text-muted">{{$program->level}}</h6>


            </div>

            <div class="alert alert-warning" role="alert">
                ⚠️ Please complete the steps below to setup this program project!
              </div>
              
            <!-- progress bar -->
            <div>
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tbody>
                        <tr>
                            <td><a class="btn btn-secondary" href="{{route('programWizard.step1', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>1</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('programWizard.step2', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>2</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('programWizard.step3', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>3</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('programWizard.step4', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>4</b> </a></td>
                            <td><a class="btn btn-success" href="{{route('programWizard.step5', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>5</b> </a></td>
                        </tr>
                        <tr>
                            <td>General Information</td>
                            <td>Program Learning Outcomes</td>
                            <td>Mapping Scale</td>
                            <td>Courses</td>
                            <td>Submit</td>
                    </tbody>
                </table>
            </div>

            <div class="card">

                <div class="card-header">
                    Submit Program Project Settings 
                </div>

                <div class="card-body">
                    Verify the settings for this program project and click Submit. Until you submit the curriculum project settings, the instructors will not be able to enter their course information. 
                    
                    <div class="text-center">
                        <a href="{{route('programs.submit', $program->program_id)}}">
                            <button class="btn btn-primary btn-sm col-4">Submit Program Project Settings</button>
                        </a>

                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{route('programWizard.step4', $program->program_id)}}"><button
                        class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Courses</button></a>
                </div>


            </div>
        </div>










    </div>
</div>
</div>
</div>
@endsection