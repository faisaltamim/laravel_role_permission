<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Backend\CustomFunction;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr as TostrMsg;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginRoute() {
        return view( 'Backend.Auth.login' );
    }

    public function login( Request $req ) {
        // Validate Login Data
        $validatedData = $req->validate(
            [
                'email'    => 'required|max:100',
                'password' => 'required',

            ],
            // error msg add manually
            [
                'email.required'    => 'Please insert admin email',
                'password.required' => 'Please insert admin password',
            ] );

        // Attempt to login
        if ( Auth::guard( 'admin' )->attempt( ['email' => $req->email, 'password' => $req->password] ) ) {

            // Redirect to dashboard
            $title = "You're Logged In!";
            $msg   = Str::title( "Welcome to admin dashboard!" );
            TostrMsg::success( $msg, $title, CustomFunction::ToastSettings() );
            return redirect()->intended( route( 'admin.dashboard' ) );

        } elseif ( Auth::guard( 'admin' )->attempt( ['username' => $req->email, 'password' => $req->password] ) ) {

            // Search using username
            $title = "You're Logged In!";
            $msg   = Str::title( "Welcome to admin dashboard!" );
            TostrMsg::success( $msg, $title, CustomFunction::ToastSettings() );
            return redirect()->intended( route( 'admin.dashboard' ) );

        } else {

            // error
            $title = "Login Error!";
            $msg   = Str::title( "Credentials did not match!" );
            session()->flash( 'error', $msg );
            // TostrMsg::error( $msg, $title, CustomFunction::ToastSettings() );
            return redirect()->back();
        }
    }

    public function logout() {

        Auth::guard( 'admin' )->logout();

        $title = "You're Logged Out!";
        $msg   = Str::title( "You're successfully logged out!" );
        TostrMsg::info( $msg, $title, CustomFunction::ToastSettings() );
        return redirect()->route( 'admin.login' );
    }

}
