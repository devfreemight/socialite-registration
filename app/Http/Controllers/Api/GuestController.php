<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegistration;
use Illuminate\Support\Facades\Validator;
use App\Registrant;

class GuestController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $defaultCity = '072217';
        return Registrant::create([
            "name"          => $data['name'],
            "gender"        => $data['gender'],
            "birthday"      => date('Y-m-d', strtotime($data['birthday'])),
            "contact_no"    => $data['contact_no'],
            "age"           => $data['age'],
            "street"        => $data['street'],
            "barangay_id"   => $data['barangay_id'],
            "city_id"       => $defaultCity,
            "landmark"      => $data['landmark'],
            "export_status" => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistration $request)
    {
        if ($request->validated()) {
            $registrant = $this->create($request->all());

            if ($registrant) {
                return response()->json([
                    'success' => true,
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed to save!'
                ], 400);
            }
        }
    }

}
