<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //

    public function getAllUser(){
        $user = User::all();
        return $user;
    }
}