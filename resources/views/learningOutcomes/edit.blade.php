@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Edit Learning Outcome</div>

                <div class="card-body">
                    <form method="POST" action="{{route('learningOutcomes.update', $l_outcome->l_outcome_id)}}">
                        @csrf
                        {{method_field('PUT')}}
                            <div class="form-group row">
                                <label for="l_outcome" class="col-md-2 col-form-label text-md-right">Learning Outcome</label>

                                <div class="col-md-8">
                                    <input id="l_outcome" type="text"
                                        class="form-control @error('l_outcome') is-invalid @enderror"
                                        name="l_outcome" value="{{$l_outcome->l_outcome}}" required autofocus>

                                    @error('l_outcome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection