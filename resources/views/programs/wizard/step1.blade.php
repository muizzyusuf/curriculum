@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('programs.wizard.header')

            <!-- progress bar -->
            <div>
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tr>
                        <td><a class="btn btn-primary" href="{{route('programWizard.step1', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>1</b> </a></td>
                        <td><a class="btn @if($msCount<1) btn-secondary @else btn-success @endif" href="{{route('programWizard.step2', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>2</b> </a></td>
                        <td><a class="btn @if($courseCount<1) btn-secondary @else btn-success @endif" href="{{route('programWizard.step3', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>3</b> </a></td>
                        <td><a class="btn btn-secondary" href="{{route('programWizard.step4', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>4</b> </a></td>
                    </tr>
                    <tr>
                        <td>Program Learning Outcomes</td>
                        <td>Mapping Scale</td>
                        <td>Courses</td>
                        <td>Begin Mapping Program</td>
                    </tr>
                </table>
            </div>

            

            <div class="card">
                

                <div class="card-body">
                    
                    <p class="card-text text-muted">Program-level learning outcomes (PLOs) are the knowledge, skills and attributes that students are expected to attain by the end of a program of study. 
                        You can add, edit and delete program outcomes. <strong>It is recommended that a program has 6 - 8 PLOs max</strong>. You can also add program outcome categories to group outcomes (optional).
                    </p>
         
                    <div id="ploCategory" class="card">
                        <div class="card-header">
                            <b>Program Learning Outcome Categories</b>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless">

                                @if(count($ploCategories)<1)
                                    <tr class="table-active">
                                        <th colspan="2">There are no program learning outcome categories set for this program project.</th>
                                    </tr>
                                @else
                                   
                                    @foreach($ploCategories as $category)
                                        <tr>
                                            <td>
                                                {{$category->plo_category}}
                                            </td>
                                            <td style="width:15%">
                                                <form action="{{route('ploCategory.destroy', $category->plo_category_id)}}" method="POST" class="float-right ml-2">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                                    <button type="submit" style="width:60px" class="btn btn-danger btn-sm ">Delete</button>
                                                </form>

                                                <button type="button" class="btn btn-secondary btn-sm float-right" data-toggle="modal" style="width:60px;" data-target="#editCategoryModal{{$category->plo_category_id}}">
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editCategoryModal{{$category->plo_category_id}}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editCategoryModalLabel">Edit 
                                                                    Program Learning Outcome Category</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ action('PLOCategoryController@update', $category->plo_category_id) }}">
                                                                @csrf
                                                                {{method_field('PUT')}}

                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="category" class="col-md-4 col-form-label text-md-right">Category Name</label>
                            
                                                                        <div class="col-md-8">
                                                                        <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{$category->plo_category}}" autofocus>
                            
                                                                            @error('category')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

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
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-sm col-2 mt-3 float-right" data-toggle="modal" data-target="#addCategoryModal">
                                ＋ Add PLO Category
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCategoryModalLabel">Add a Program Learning Outcome Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ action('PLOCategoryController@store') }}">
                                            @csrf

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="category" class="col-md-4 col-form-label text-md-right">Category Name</label>

                                                    <div class="col-md-8">
                                                        <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" autofocus>

                                                        @error('category')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

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
                    </div>

                    <div id="plo" class="card mt-3">
                        <div class="card-header">
                            <b>Program Learning Outcomes</b>
                        </div>
                        <div class="card-body">

                                @if(count($plos)<1) 
                                    <table class="table table-sm table-borderless">
                                        <tr class="table-active">
                                            <th colspan="2">There are no program learning outcomes for this program project.</th>
                                        </tr>
                                    </table>
                                @else
                                    @if(count($ploCategories)<1)
                                        @foreach($plos as $plo)

                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>
                                                    <b>{{$plo->plo_shortphrase}}</b><br>
                                                    {{$plo->pl_outcome}}
                                                </td>
                                                <td style="width:15%">
                                                    <form action="{{route('plo.destroy', $plo->pl_outcome_id)}}" method="POST" class="float-right ml-2">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                                        <button type="submit" style="width:60px" class="btn btn-danger btn-sm ">Delete</button>
                                                    </form>

                                                    <button type="button" class="btn btn-secondary btn-sm float-right" data-toggle="modal" style="width:60px; " data-target="#editPLOModal{{$plo->pl_outcome_id}}">
                                                        Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editPLOModal{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="editPLOModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editPLOModalLabel">Edit Program Learning Outcome</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <form method="POST" action="{{ action('ProgramLearningOutcomeController@update', $plo->pl_outcome_id) }}">
                                                                    @csrf
                                                                    {{method_field('PUT')}}

                                                                    <div class="modal-body">

                                                                        <div class="form-group row">
                                                                            <label for="plo" class="col-md-4 col-form-label text-md-right">Program Learning Outcome</label>

                                                                            <div class="col-md-8">
                                                                                <textarea id="plo" class="form-control" @error('plo') is-invalid @enderror rows="3" name="plo" required autofocus>{{$plo->pl_outcome}}
                                                                                </textarea>

                                                                                @error('plo')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>
                        
                                                                            <div class="col-md-8">
                                                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$plo->plo_shortphrase}}" autofocus>
                        
                                                                                @error('title')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                        
                                                                                <small class="form-text text-muted">
                                                                                    Having a short phrase helps with data visualization at the end of this process <b>(4 words max)</b>.
                                                                                </small>
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

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
                                        </table>
                                        @endforeach
                                    @else
                                        @foreach($ploCategories as $category)

                                            <div class="card my-2">
                                                <div class="card-header">
                                                    {{$category->plo_category}}
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-sm table-borderless">
                                                        @foreach($plos as $plo)
                                                            @if($plo->plo_category_id == $category->plo_category_id)
                                                                <tr>
                                                                    <td>
                                                                        <b>{{$plo->plo_shortphrase}}</b><br>
                                                                        {{$plo->pl_outcome}}
                                                                    </td>
                                                                    <td style="width:15%">
                                                                        <form action="{{route('plo.destroy', $plo->pl_outcome_id)}}" method="POST" class="float-right ml-2">
                                                                            @csrf
                                                                            {{method_field('DELETE')}}
                                                                            <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>
            
                                                                            <button type="submit" style="width:60px" class="btn btn-danger btn-sm ">Delete</button>
                                                                        </form>
            
                                                                        <button type="button" class="btn btn-secondary btn-sm float-right" data-toggle="modal" style="width:60px; " data-target="#editPLOModal{{$plo->pl_outcome_id}}">
                                                                            Edit
                                                                        </button>
            
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="editPLOModal{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="editPLOModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="editPLOModalLabel">Edit Program Learning Outcome</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
            
                                                                                    <form method="POST" action="{{ action('ProgramLearningOutcomeController@update', $plo->pl_outcome_id) }}">
                                                                                        @csrf
                                                                                        {{method_field('PUT')}}
            
                                                                                        <div class="modal-body">
            
                                                                                            <div class="form-group row">
                                                                                                <label for="plo" class="col-md-4 col-form-label text-md-right">Program Learning Outcome</label>
            
                                                                                                <div class="col-md-8">
                                                                                                    <textarea id="plo" class="form-control" @error('plo') is-invalid @enderror rows="3" name="plo" required autofocus>{{$plo->pl_outcome}}
                                                                                                    </textarea>
            
                                                                                                    @error('plo')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
            
                                                                                            <div class="form-group row">
                                                                                                <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>
                                        
                                                                                                <div class="col-md-8">
                                                                                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$plo->plo_shortphrase}}" autofocus>
                                        
                                                                                                    @error('title')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                    @enderror
                                        
                                                                                                    <small class="form-text text-muted">
                                                                                                        Having a short phrase helps with data visualization at the end of this process <b>(4 words max)</b>.
                                                                                                    </small>
                                                                                                </div>
                                                                                            </div>
            
                                                                                            @if(count($ploCategories)>0)
                                                                                                <div class="form-group row">
                                                                                                    <label for="category" class="col-md-4 col-form-label text-md-right">PLO Category</label>
            
                                                                                                    <div class="col-md-8">
                                                        
                                                                                                        <select class="custom-select" name="category" id="category" required autofocus>
                                                                                                            @foreach($ploCategories as $c)
                                                                                                                @if($c->plo_category == $category->plo_category)
                                                                                                                    <option selected value="{{$c->plo_category_id}}">{{$c->plo_category}}</option>
                                                                                                                @else
                                                                                                                    <option value="{{$c->plo_category_id}}">{{$c->plo_category}}</option>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                            <option value="">None</option>
                                                                                                        </select>
            
                                                                                                        @error('category')
                                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
            
                                                                                            <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>
            
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
                                                            @endif
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        
                                        @endforeach

                                        <div class="card">
                                            <div class="card-header">
                                                Uncategorised Outcomes
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-sm table-borderless">
                                                    @foreach($plos as $plo)
                                                        @if($plo->plo_category_id == null)
                                                            <tr>
                                                                <td>
                                                                    <b>{{$plo->plo_shortphrase}}</b><br>
                                                                    {{$plo->pl_outcome}}
                                                                </td>
                                                                <td>
                                                                    <form action="{{route('plo.destroy', $plo->pl_outcome_id)}}" method="POST" class="float-right ml-2">
                                                                        @csrf
                                                                        {{method_field('DELETE')}}
                                                                        <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                                                        <button type="submit" style="width:60px" class="btn btn-danger btn-sm ">Delete</button>
                                                                    </form>

                                                                    <button type="button" class="btn btn-secondary btn-sm float-right" data-toggle="modal" style="width:60px; " data-target="#editPLOModal{{$plo->pl_outcome_id}}">
                                                                        Edit
                                                                    </button>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="editPLOModal{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="editPLOModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="editPLOModalLabel">Edit Program Learning Outcome</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>

                                                                                <form method="POST" action="{{ action('ProgramLearningOutcomeController@update', $plo->pl_outcome_id) }}">
                                                                                    @csrf
                                                                                    {{method_field('PUT')}}

                                                                                    <div class="modal-body">

                                                                                        <div class="form-group row">
                                                                                            <label for="plo" class="col-md-4 col-form-label text-md-right">Program Learning Outcome</label>

                                                                                            <div class="col-md-8">
                                                                                                <textarea id="plo" class="form-control" @error('plo') is-invalid @enderror rows="3" name="plo" required autofocus>{{$plo->pl_outcome}}
                                                                                                </textarea>

                                                                                                @error('plo')
                                                                                                    <span class="invalid-feedback" role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>
                                        
                                                                                            <div class="col-md-8">
                                                                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$plo->plo_shortphrase}}" autofocus>
                                        
                                                                                                @error('title')
                                                                                                    <span class="invalid-feedback" role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                        
                                                                                                <small class="form-text text-muted">
                                                                                                    Having a short phrase helps with data visualization at the end of this process <b>(4 words max)</b>.
                                                                                                </small>
                                                                                            </div>
                                                                                        </div>

                                                                                        @if(count($ploCategories)>0)
                                                                                            <div class="form-group row">
                                                                                                <label for="category" class="col-md-4 col-form-label text-md-right">PLO Category</label>

                                                                                                <div class="col-md-8">
                                                        
                                                                                                    <select class="custom-select" name="category" id="category" required autofocus>
                                                                                                        <option selected hidden disabled>Choose...</option>
                                                                                                        @foreach($ploCategories as $c)
                                                                                                            <option value="{{$c->plo_category_id}}">{{$c->plo_category}}</option>
                                                                                                        @endforeach
                                                                                                        <option value="">None</option>
                                                                                                    </select>
                                                                                                    
                                                                                                    @error('category')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif

                                                                                        <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

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
                                                        @endif
                                                    @endforeach
                                                </table>
                                                
                                            </div>
                                        </div>
                                        
                                    @endif
                                @endif
                            
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-sm col-2 mt-3 float-right" data-toggle="modal" data-target="#addPLOModal">
                                ＋ Add PLO
                            </button>
        
                            <!-- Modal -->
                            <div class="modal fade" id="addPLOModal" tabindex="-1" role="dialog"
                                aria-labelledby="addPLOModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPLOModalLabel">Add a Program Learning Outcome</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
        
                                        <form method="POST" action="{{ action('ProgramLearningOutcomeController@store') }}">
                                            @csrf
        
                                            <div class="modal-body">
        
                                                <div class="form-group row">
                                                    <label for="plo" class="col-md-4 col-form-label text-md-right">Program Learning Outcome</label>
        
                                                    <div class="col-md-8">
                                                        <textarea id="plo" class="form-control" @error('plo') is-invalid @enderror rows="3" name="plo" required autofocus>
                                                        </textarea>
        
                                                        @error('plo')
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
                                                            Having a short phrase helps with data visualization at the end of this process <b>(4 words max)</b>.
                                                        </small>
                                                    </div>
                                                </div>
        
                                                @if(count($ploCategories)>0)
                                                    <div class="form-group row">
                                                        <label for="category" class="col-md-4 col-form-label text-md-right">PLO Category</label>
        
                                                        <div class="col-md-8">
                                                        
                                                            <select class="custom-select" name="category" id="category" required autofocus>
                                                                <option selected hidden disabled>Choose...</option>
                                                                @foreach($ploCategories as $c)
                                                                    <option value="{{$c->plo_category_id}}">{{$c->plo_category}}</option>
                                                                @endforeach
                                                                <option value="">None</option>
                                                            </select>
        
                                                            @error('category')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
        
                                                <input type="hidden" class="form-check-input" name="program_id"
                                                    value={{$program->program_id}}>
        
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary col-2 btn-sm"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>     

                </div>
       
                <div class="card-footer"> 

                    <a href="{{route('programWizard.step2', $program->program_id)}}"><button
                            class="btn btn-sm btn-primary mt-3 col-3 float-right">Mapping Scale ➡</button></a>
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