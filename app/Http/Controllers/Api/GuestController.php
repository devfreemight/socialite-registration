<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistration;
use App\Services\RegistrantService;
use Illuminate\Validation\ValidationException;
use Exception;

class GuestController extends Controller
{
    protected $registrantService;

    public function __construct(RegistrantService $registrantService)
    {
        $this->registrantService = $registrantService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistration $request)
    {
        $data = $request->only([
            'name',
            'birthday',
            'contact_no',
            'age',
            'street',
            'barangay',
            'city_id',
            'landmark',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->registrantService->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 422,
                'errors' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function checkRegistration($token)
    {
        $result = ['msg' => 'Registration token valid.'];

        $registrant = \App\Registrant::where('registration_token', $token)->firstOr(function () {
            throw ValidationException::withMessages([
                'token' => __('validation.custom.invalid_registration_token')
            ]);
        });

        if (\Carbon\Carbon::parse($registrant->created_at)->addHours(24)->isPast()) {
            throw ValidationException::withMessages([
                'token' => __('validation.custom.registration_token'),
            ]);
        }

        return response()->json($result);
    }

}
