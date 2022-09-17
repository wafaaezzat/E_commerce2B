<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function __construct(){   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }

    public function submitContact(Request $request)
    {
        Contact::create([
            'Name' => (Auth::user()->firstname .' '. Auth::user()->lastname),
            'email' => $request->email,
            'phone'=> $request->phone,
            'message' => $request->message,
        ]);
        toastr()->success('Success Send Your Contacts');
        return redirect()->back();
    }


}
