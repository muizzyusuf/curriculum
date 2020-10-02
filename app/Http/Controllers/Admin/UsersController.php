<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Gate;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Gate::denies('admin-privilege')){
            return redirect(route('home'));
        }

        $users = User::all();
        return view('admin.users.index')->with('users',$users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        if(Gate::denies('admin-privilege')){
            return redirect(route('admin.users.index'));
        }

        $roles = Role::all();
        return view('admin.users.edit')->with('user', $user)->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()){
            $request->session()->flash('success', $user->name.' has been updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the user');
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        
        if(Gate::denies('admin-privilege')){
            return redirect(route('admin.users.index'));
        }

        if($user->delete()){
            $request->session()->flash('success', $user->name.' has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the user');
        }
        return redirect()->route('admin.users.index');
    }
}
