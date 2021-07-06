<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitySelectionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cities = \App\City::all();
        return view('registration.select-city', compact('cities'));
    }
}
