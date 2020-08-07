<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkAdminLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->user_type_id == 0 || Auth::user()->user_type_id == 3) {
                return User::find(Auth::user()->user_id);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
