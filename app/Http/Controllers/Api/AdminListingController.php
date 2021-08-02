<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateRegistrant;
use App\Registrant;
use App\Services\RegistrantService;
use Excel;
use Exception;

class AdminListingController extends Controller
{
    protected $registrantService;

    public function __construct(RegistrantService $registrantService)
    {
        $this->registrantService = $registrantService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'name'          => 'string|max:255',
            'gender'        => 'in:1',
            'contact_no'    => 'numeric|max:11',
            'age'           => 'numeric',
            'export_status' => 'in:0,1',
            'barangay_id'   => 'string',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->registrantService->getAll($request->input());
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function exportCSV(Request $request)
    {
        $this->registrantService->updateExportStatus($request->input());
        return Excel::download(new \App\Exports\RegistrantExport($request->input()), 'registrants.csv');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registrant = Registrant::firstWhere('id', $id);
        return response()->json(['data' => $registrant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegistrant $request, $id)
    {
        if ($request->validated()) {
            $registrant = $this->updateRecord($request->input(), $id);

            if ($registrant) {
                return response()->json([
                    'success' => true,
                    'data' => $registrant,
                    'message' => 'Record updated successfully.'
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Record failed to update!'
                ], 400);
            }
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function updateRecord(array $data, $id)
    {
        $registrant = Registrant::find($id);
        $registrant->name        = $data['name'];
        $registrant->gender      = $data['gender'];
        $registrant->birthday    = date('Y-m-d', strtotime($data['birthday']));
        $registrant->contact_no  = $data['contact_no'];
        $registrant->age         = $data['age'];
        $registrant->street      = $data['street'];
        $registrant->barangay_id = $data['barangay_id'];
        $registrant->city_id     = $data['city_id'];
        $registrant->landmark    = $data['landmark'];
        $registrant->save();
        return $registrant;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registrant = Registrant::find($id);

        if ($registrant->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully.'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Record failed to delete!'
            ], 400);
        }
    }
}
