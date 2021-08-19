<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRegistrant;
use App\Services\RegistrantService;
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
            'contact_no'    => 'string|max:11',
            'age'           => 'numeric',
            'export_status' => 'in:0,1',
            'barangay'      => 'string',
            'city_id'       => 'string',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->registrantService->getAll($request->input());
        } catch (Exception $e) {
            $result = [
                'status' => 422,
                'errors' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function exportCSV(Request $request)
    {
        $this->registrantService->updateExportStatus($request->input());
        return \Excel::download(new \App\Exports\RegistrantExport($request->input()), 'registrants.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->registrantService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 422,
                'errors' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
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
            $result['data'] = $this->registrantService->updateData($data, $id);
            $result['message'] = 'Record updated successfully.';
        } catch (Exception $e) {
            $result = [
                'status' => 422,
                'errors' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->registrantService->deleteById($id);
            $result['message'] = 'Record deleted successfully.';
        } catch (Exception $e) {
            $result = [
                'status' => 422,
                'errors' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
