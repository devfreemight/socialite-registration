<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function showRegistrationForm(Request $request)
    {
        return view('registration.form')->with('city_id', $request->input('city_id'));
    }

    public function setRegistrationForm(Request $request)
    {
        return view('registration.form', $request->query());
    }
}
