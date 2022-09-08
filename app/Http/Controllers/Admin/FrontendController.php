<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function __construct(){   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.pages.Dashboard.dashboard');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.pages.users.users' , compact('users'));
    }

    public function usersView($id){
        $user = User::where('id' , $id)->first();
        return view('admin.pages.users.view' , compact('user'));
    }

}
