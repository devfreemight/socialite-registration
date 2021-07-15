<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barangay;

class BarangayController extends Controller
{
    public function getList(Request $request)
    {
        $list = Barangay::where('city_id', $request->city_id)
            ->orderBy('name', 'asc')
            ->get();
        return response()->json(['data' => $list]);
    }
}
