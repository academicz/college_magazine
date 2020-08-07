<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function user()
{
    if (Auth::check()) {
        return Auth::user()->user_type_id == 1 ? User::find(Auth::user()->user_id) : false;
    } else {
        return false;
    }
}

function admin()
{
    if (Auth::check()) {
        return Auth::user()->user_type_id == 0 ? User::find(Auth::user()->user_id) : false;
    } else {
        return false;
    }
}

function moderator()
{
    if (Auth::check()) {
        return Auth::user()->user_type_id == 3 ? User::find(Auth::user()->user_id) : false;
    } else {
        return false;
    }
}



function dateFromTimeStamp($timeStamp)
{
    $date = new  Carbon($timeStamp);
    return $date->format('d F Y');
}