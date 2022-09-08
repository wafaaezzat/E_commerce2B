<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct(){   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }

    public function index()
    {
        $newContacts = Complaint::all();
        return view('admin.pages.Contacts.index' , compact('newContacts'));
    }

    public function destroy($id)
    {
        $product = Complaint::findOrFail($id)->first();
        $product->delete();
        toastr()->error('Successfully Deleted This Message');
        return redirect()->back();

    }



}
