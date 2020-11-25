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
                            <td><a class="btn btn-success" href="{{route('courseWizard.step1', $course->course_id)}}"
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
                    <p class="form-text text-muted">On	this	page,	you	can	add,	edit	or	delete	the	course learning	outcomes in	you	course.</p>

                    <div id="clo">
                        <div class="row">
                            <div class="col">
                                <table class="table table-borderless">

                                    @if(count($l_outcomes)<1) 
                                        <tr class="table-active">
                                            <th colspan="3">There are no course learning outcomes set for this course.</th>
                                        </tr>


                                    @else

                                        <tr class="table-active">
                                            <th colspan="2">Course Learning Outcomes</th>
                                        </tr>
                                      
                                            @foreach($l_outcomes as $l_outcome)

                                            <tr>
                                                <td>
                                                    <b>{{$l_outcome->clo_shortphrase}}</b><br>
                                                    {{$l_outcome->l_outcome}}
                                                </td>
                                                <td>
                                                    <form class="float-right ml-2" action="{{route('lo.destroy', $l_outcome->l_outcome_id)}}" method="POST">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                        <button style="width:60px;" type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                                    </form>

                                                    <button type="button" style="width:60px;" class="btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#editLearningOutcomeModal{{$l_outcome->l_outcome_id}}">
                                                        Edit
                                                    </button>
                                
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editLearningOutcomeModal{{$l_outcome->l_outcome_id}}" tabindex="-1" role="dialog"
                                                        aria-labelledby="editLearningOutcomeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editLearningOutcomeModalLabel">Edit Course Learning Outcome
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                
                                                                <form method="POST" action="{{ route('lo.update', $l_outcome->l_outcome_id) }}">
                                                                    @csrf
                                                                    {{method_field('PUT')}}
                                                                    <div class="modal-body">
                                                                        
                                                                        <div class="form-group row">
                                                                            <label for="l_outcome" class="col-md-4 col-form-label text-md-center">Course Learning Outcome</label>
                                
                                                                            <div class="col-md-8">
                                                                                <textarea id="l_outcome" class="form-control" @error('l_outcome') is-invalid @enderror rows="3" name="l_outcome" required autofocus>{{$l_outcome->l_outcome}}
                                                                                </textarea>
                                        
                                                                                @error('l_outcome')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>
                                
                                                                            <div class="col-md-8">
                                                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$l_outcome->clo_shortphrase}}" autofocus>
                                
                                                                                @error('title')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror

                                                                                <small class="form-text text-muted">
                                                                                    This is a short phrase in a few words summarising your CLO
                                                                                  </small>

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

                    <button type="button" class="btn btn-primary btn-sm col-3 mt-3 float-right" data-toggle="modal" data-target="#addLearningOutcomeModal">
                        ＋ Add Course Learning Outcome
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addLearningOutcomeModal" tabindex="-1" role="dialog"
                        aria-labelledby="addLearningOutcomeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addLearningOutcomeModalLabel">Add Course Learning Outcome
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" action="{{ action('LearningOutcomeController@store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="l_outcome" class="col-md-4 col-form-label text-md-center">Course Learning Outcome</label>

                                            <div class="col-md-8">
                                                <textarea id="l_outcome" class="form-control" @error('l_outcome') is-invalid @enderror rows="3" name="l_outcome" required autofocus></textarea>
        
                                                @error('l_outcome')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>

                                            <div class="col-md-8">
                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" autofocus>

                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <small class="form-text text-muted">
                                                    This is a short phrase in a few words summarising your CLO
                                                </small>
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
                    <a href="{{route('courseWizard.step0', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ General Information</button>
                    </a>
                    
                    <a href="{{route('courseWizard.step2', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Student Assessment Methods ➡</button>
                    </a>
                </div>


            </div>
        </div>


    </div>
</div>

@endsection