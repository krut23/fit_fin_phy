<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session, Hash;

class AuthenticationController extends BaseController
{

    /*
     * Display a view
     * Method GET
     */
    public function index() {
        $title = 'Login';
        return view('admin.authentication.login', ['title' => $title]);
    }

    /*
     * Store authentication
     * Method POST
     */
    public function store(Request $req) {
        $remember = ($req->remember) ? true : false;
        $userData = Auth::attempt(['email' => $req->email, 'password' => $req->password], $remember);
        if (!empty($userData)) {
            // a(Auth::user());
            if (Auth::user()->is_active) {
                return redirect()->route('dashboard');
            }
            Session::flash('message', 'Your account has been disabled.');
            return redirect()->back();
        }

        Session::flash('message', 'Incorrect Email or Password.');
        return redirect()->back();
    }

    /*
     * Logout
     * Method GET
     */
    public function logout() {
        $title = 'Logout';
        Session::forget('switchBackProfileUserId');
        Auth::logout();
        return redirect()->back();
//        return view('admin.authentication.logout', ['title' => $title]);
    }

    public function switchAccount($accountType, $userId) {
        if(Auth::user()->is_admin) {
//            Session::get('switchBackProfileUserId');
            Session::put('switchBackProfileUserId', Auth::user()->id);
        }
//        dd(Session::get('switchBackProfileUserId'));


        Auth::logout();
        Auth::loginUsingId($userId);

    	return redirect()->route('dashboard');
    }

    public function notAccess() {
        $title = 'Not Access';
    	return view('admin.errors.no-access', ['title' => $title]);
    }
}
