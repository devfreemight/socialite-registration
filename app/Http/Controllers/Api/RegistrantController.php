<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateRegistrant;
use App\Registrant;
use Excel;
class RegistrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'gender' => 'in:0,1',
            'birthday' => 'date|date_format:m/d/Y',
            'contact_no' => 'max:11',
            'age' => 'numeric|between:18,30',
            'street' => 'max:255',
            'landmark' => 'max:255',
        ]);

        $birthday = $request->filled('birthday') ? date('Y-m-d', strtotime($request->input('birthday'))) : '';

        $registrants = DB::table('registrants')
            ->join('cities', 'registrants.city_id', '=', 'cities.city_id')
            ->join('barangays', 'registrants.barangay_id', '=', 'barangays.brgy_id')
            ->select('registrants.*', 'cities.name AS city_name', 'barangays.name AS barangay_name')
            ->where('registrants.name', 'like', '%' . $request->input('name') . '%')
            ->where('gender', 'like', $request->input('gender') . '%')
            ->where('birthday', 'like', '%' . $birthday . '%')
            ->where('contact_no', 'like', '%' . $request->input('contact_no') . '%')
            ->where('age', 'like', $request->input('age') . '%')
            ->where('street', 'like', '%' . $request->input('street') . '%')
            ->where('registrants.barangay_id', 'like', $request->input('barangay_id') . '%')
            ->where('registrants.city_id', $request->input('city_id'))
            ->where('landmark', 'like', '%' . $request->input('landmark') . '%')
            ->orderBy('registrants.name', 'asc')
            ->paginate(15);

        return response()->json($registrants);
    }

    public function exportCSV(Request $request)
    {
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
