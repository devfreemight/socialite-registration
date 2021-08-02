<?php

namespace App\Services;

use App\Registrant;
use App\Repositories\RegistrantRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class RegistrantService
{
    protected $registrantRepository;

    public function __construct(RegistrantRepository $registrantRepository)
    {
        $this->registrantRepository = $registrantRepository;
    }

    public function getAll($data)
    {
        $requests = ['name', 'gender', 'contact_no', 'age', 'export_status', 'barangay_id'];

        foreach ($requests as $key) {
            if (!isset($data[$key])) {
                $data[$key] = '';
            }
        }

        return $this->registrantRepository->getAll($data);
    }

    public function getById($id)
    {
        return $this->registrantRepository->getById($id);
    }

    public function updateData($data, $id)
    {
        DB::beginTransaction();

        try {
            $registrant = $this->registrantRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update registrant data');
        }

        DB::commit();
        return $registrant;
    }

    public function saveData($data)
    {
        $result = $this->registrantRepository->save($data);
        return $result;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $registrant = $this->registrantRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete registrant data');
        }

        DB::commit();
        return $registrant;
    }

    public function updateExportStatus($data)
    {
        try {
            $status = $this->registrantRepository->updateExportStatus($data);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update export status');
        }

        return $status;
    }

}
