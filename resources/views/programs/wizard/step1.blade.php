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

            <!-- progress bar -->
            <div>
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tbody>
                        <tr>
                            <td><a class="btn btn-success" href="{{route('programWizard.step1', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>1</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('programWizard.step2', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>2</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('programWizard.step3', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>3</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('programWizard.step4', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>4</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('programWizard.step5', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>5</b> </a></td>
                        </tr>
                        <tr>
                            <td>General Information</td>
                            <td>Program Learning Outcomes</td>
                            <td>Mapping Scale</td>
                            <td>Courses</td>
                            <td>Submit</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card">

                <div class="card-body">
                    <div id="edit delete info" class="row mb-5">
                        <div class="col">
                            <button type="button" style="width:200px" class="btn btn-outline-secondary btn-sm float-right" data-toggle="modal"
                                data-target="#editInfoModal">
                                Edit Information
                            </button>
                        </div>

                        <div class="col">
                            <form action="{{route('programs.destroy', $program->program_id)}}" method="POST" class="float-left">
                                @csrf
                                {{method_field('DELETE')}}
        
                                <button type="submit" style="width:200px" class="btn btn-danger btn-sm ">Delete Entire Program</button>
                            </form>
                        </div>



                        <!-- Modal -->
                        <div class="modal fade" id="editInfoModal" tabindex="-1" role="dialog"
                            aria-labelledby="editInfoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editInfoModalLabel">Edit Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form method="POST"
                                        action="{{ action('ProgramController@update', $program->program_id) }}">
                                        @csrf
                                        {{method_field('PUT')}}
                                        <div class="modal-body">


                                            <div class="form-group row">
                                                <label for="program"
                                                    class="col-md-2 col-form-label text-md-right">Program
                                                    Name</label>

                                                <div class="col-md-8">
                                                    <input id="program" type="text"
                                                        class="form-control @error('program') is-invalid @enderror"
                                                        name="program" value="{{$program->program}}" required autofocus>

                                                    @error('program')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="faculty"
                                                    class="col-md-2 col-form-label text-md-right">Faculty</label>

                                                <div class="col-md-8">
                                                    <select id='faculty' class="custom-select" name="faculty" required>
                                                        @for($i =0; $i<count($faculties) ; $i++) @if($faculties[$i]==$program->faculty)
                                                            <option value="{{$program->faculty}}" selected>
                                                                {{$program->faculty}}</option>
                                                            @else
                                                            <option value="{{$faculties[$i]}}">{{$faculties[$i]}}
                                                            </option>
                                                            @endif
                                                            @endfor
                                                    </select>

                                                    @error('faculty')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="department"
                                                    class="col-md-2 col-form-label text-md-right">Department</label>

                                                <div class="col-md-8">
                                                    <select id='department' class="custom-select" name="department" required>
                                                        @for($i =0; $i<count($departments) ; $i++) @if($departments[$i]==$program->department)
                                                            <option value="{{$program->department}}" selected>
                                                                {{$program->department}}</option>
                                                            @else
                                                            <option value="{{$departments[$i]}}">{{$departments[$i]}}
                                                            </option>
                                                            @endif
                                                            @endfor
                                                    </select>

                                                    @error('department')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="Level"
                                                    class="col-md-2 col-form-label text-md-right">Level</label>
                                                <div class="col-md-6">
                                                    @for($i =0; $i<2 ; $i++) @if($levels[$i]==$program->level)
                                                        <div class="form-check ">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="level" value="{{$levels[$i]}}" checked>
                                                                {{$levels[$i]}}
                                                            </label>
                                                        </div>
                                                        @else
                                                        <div class="form-check ">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="level" value="{{$levels[$i]}}">
                                                                {{$levels[$i]}}
                                                            </label>
                                                        </div>

                                                        @endif
                                                        @endfor
                                                </div>
                                            </div>

                                            <input type="hidden" class="form-check-input" name="user_id"
                                                value={{$user->id}}>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary col-2 btn-sm"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="admins">
                        <div class="row">
                            <div class="col">
                                <table class="table table-borderless">

                                    @if(count($programUsers)<2) 
                                        <tr class="table-active">
                                            <th colspan="2">You are the sole Administrator for this program project.</th>
                                        </tr>


                                    @else

                                        <tr class="table-active">
                                            <th colspan="2">Administrators</th>
                                        </tr>
                                        <div class="card-body">
                                            @foreach($programUsers as $admin)
                                                @if($admin->email != $user->email)
                                                <tr>
                                                    <td>{{$admin->email}}</td>
                                                    <td>
                                                        <form action="{{route('programUser.destroy', [$admin->program_id, $admin->user_id])}}" method="POST" class="float-left">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                    
                                                            <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                @endif

                                            @endforeach

                                        </div>

                                    @endif
                                </table>
                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm col-2 mt-3 float-right" data-toggle="modal"
                        data-target="#addAdminModal">
                        ＋ Add Administrator
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog"
                        aria-labelledby="addAdminModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addAdminModalLabel">Add Administrator</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" action="{{ action('ProgramUserController@store') }}">
                                    @csrf

                                    <div class="modal-body">


                                        <div class="form-group row">
                                            <label for="email" class="col-md-2 col-form-label text-md-right">Email
                                                Address</label>

                                            <div class="col-md-8">
                                                <input id="email" type="email"
                                                    class="form-control @error('program') is-invalid @enderror"
                                                    name="email" required autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <input type="hidden" class="form-check-input" name="program_id"
                                            value={{$program->program_id}}>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary col-2 btn-sm"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">


                    <a href="{{route('programWizard.step2', $program->program_id)}}"><button class="btn btn-sm btn-primary mt-3 col-3 float-right">Program Learning Outcomes ➡</button></a>
                </div>


            </div>
        </div>










    </div>
</div>
</div>
</div>
@endsection