<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\CustomFunction;
use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr as TostrMsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::all();
        return view( 'Backend/pages/users/index', compact( 'users' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::all();
        return view( 'Backend/pages/users/create', compact( 'roles' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $req ) {

        //validation data
        $validatedData = $req->validate(
            [
                'name'             => 'required|max:40',
                'email'            => 'required|email|unique:users',
                'password'         => 'required|min:8',
                'confirm_password' => 'required|same:password|min:8',
                'roles'            => 'required',
            ],
            // error msg add manually
            [
                'name.required'             => 'Please insert a user name',
                'name.max'                  => 'This user name should be maximum 40 characters',
                'email.required'            => 'Please insert user email',
                'email.unique'              => 'This email already has taken',
                'email.email'               => 'Please insert a valid email',
                'password.required'         => 'Please insert user password',
                'password.min'              => 'This password should be at least 8 charecters',
                'confirm_password.required' => 'Confirm user password',
                'confirm_password.min'      => 'This password should be at least 8 charecters',
                'confirm_password.same'     => "Password didn't match",
                'roles.required'            => "Please assign user role",
            ] );

        // Create New User
        $user           = new User();
        $user->name     = $req->name;
        $user->email    = $req->email;
        $user->password = Hash::make( $req->password );
        $user->save();

        //assign roles into database using spatie default schema
        if ( $req->roles ) {
            $user->assignRole( $req->roles );

            $title = "User Created!";
            $msg   = Str::title( "The user <strong>($user->name)</strong> has created" );
            TostrMsg::success( $msg, $title, CustomFunction::ToastSettings() );
            return redirect()->back();
        } else {
            return "Error went wrong!";
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $user  = User::find( $id );
        $roles = Role::all();
        return view( 'Backend/pages/users/edit', compact( 'user', 'roles' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $req, $id ) {
        //validation data
        $validatedData = $req->validate(
            [
                'name'             => 'required|max:40',
                'email'            => 'required|email|unique:users,email,' . $id,
                'password'         => 'nullable|min:8',
                'confirm_password' => 'nullable|same:password|min:8',
                'roles'            => 'required',
            ],
            // error msg add manually
            [
                'name.required'         => 'Please insert a user name',
                'name.max'              => 'This user name should be maximum 40 characters',
                'email.required'        => 'Please insert user email',
                'email.unique'          => 'This email already has taken',
                'email.email'           => 'Please insert a valid email',
                'password.min'          => 'This password should be at least 8 charecters',
                'confirm_password.min'  => 'This password should be at least 8 charecters',
                'confirm_password.same' => "Password didn't match",
                'roles.required'        => "Please assign user role",
            ] );

        // Create New User
        $user        = User::find( $id );
        $user->name  = $req->name;
        $user->email = $req->email;
        if ( $req->password ) {
            $user->password = Hash::make( $req->password );
        }
        $user->save();

        //assign roles into database using spatie default schema
        $user->roles()->detach(); //delete old roles and update automatically new role || detach() is spatie default delete method
        if ( $req->roles ) {
            $user->assignRole( $req->roles );
        }

        $title = "User Updated!";
        $msg   = Str::title( "The user <strong>($user->name)</strong> has Updated" );
        TostrMsg::success( $msg, $title, CustomFunction::ToastSettings() );
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $user = User::find( $id );
        if ( !is_null( $user ) ) {
            $user->delete();
        }

        $title = "User Deleted!";
        $msg   = Str::title( "The role <strong>($user->name)</strong> is Deleted" );
        TostrMsg::success( $msg, $title, CustomFunction::ToastSettings() );
        return redirect()->back();
    }
}
