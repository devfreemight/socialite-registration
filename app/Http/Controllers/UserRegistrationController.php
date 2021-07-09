<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function showRegistrationForm($city_id)
    {
        $city_name = \App\City::find($city_id)->name;
        return view('registration.form', compact('city_id', 'city_name'));
    }

    public function setRegistrationForm(Request $request)
    {
        return view('registration.form', $request->query());
    }
}
