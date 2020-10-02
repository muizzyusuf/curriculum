@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>Role</th>
                                <th scope='col'>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td scope="row">{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ implode(', ', $user->roles()->get()->pluck('role')->toArray()) }}</td>
                                    <td>
            
                                        <a href="{{route('admin.users.edit', $user->id)}}"><button type="button" class="btn btn-warning float-left">Edit</button></a>
                                        
                                        <form action="{{route('admin.users.destroy', $user)}}" method="POST" class="float-left">
                                            @csrf
                                            {{method_field('DELETE')}}
                    
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                    
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection

