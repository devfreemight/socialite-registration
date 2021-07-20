<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'name' => 'string|max:255|unique:registrants',
            'gender' => 'in:0,1',
            'birthday' => 'date',
            'contact_no' => 'min:11|unique:registrants',
            'age' => 'numeric|between:18,30',
            'street' => 'max:255',
            'landmark' => 'max:255',
        ]);

        $registrants = DB::table('registrants')
            ->join('cities', 'registrants.city_id', '=', 'cities.city_id')
            ->join('barangays', 'registrants.barangay_id', '=', 'barangays.brgy_id')
            ->select('registrants.*', 'cities.name AS city_name', 'barangays.name AS barangay_name')
            ->where('registrants.name', 'like', $request->input('name') . '%')
            ->where('gender', 'like', $request->input('gender') . '%')
            ->where('birthday', 'like', $request->input('birthday') . '%')
            ->where('contact_no', 'like', $request->input('contact_no') . '%')
            ->where('age', 'like', $request->input('age') . '%')
            ->where('street', 'like', $request->input('street') . '%')
            ->where('registrants.barangay_id', 'like', $request->input('barangay_id') . '%')
            ->where('registrants.city_id', 'like', $request->input('city_id') . '%')
            ->where('landmark', 'like', $request->input('landmark') . '%')
            ->orderBy('registrants.name', 'asc')
            ->get();

        return response()->json(['data' => $registrants]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
