<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getAdminLoginPage()
    {
        $data = [
            'magazine' => env('MAGAZINE_NAME')
        ];
        return view('Admin.login', $data);
    }

    public function postAdminLogin(Request $request)
    {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->back()->with(['error' => 'Could Not Log You In!']);
        }
        return redirect()->route('adminHome');
    }

    public function AdminLogout()
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }

    public function getLogin()
    {
        return view('Public.login');
    }

    public function postLogin(Request $request)
    {
        if (!Auth::attempt(['email' => $request['username'], 'password' => $request['password'], 'user_type_id' => 1])) {
            return redirect()->back()->with(['error' => 'Could Not Log You In!']);
        }
        return redirect()->route('home');
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
