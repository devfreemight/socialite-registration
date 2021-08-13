<?php

namespace App\Repositories;

use App\Registrant;
use App\Repositories\RegistrantRepositoryInterface;

class RegistrantRepository implements RegistrantRepositoryInterface
{
    protected $registrant;

    public function __construct(Registrant $registrant)
    {
        $this->registrant = $registrant;
    }

    public function getAll($data)
    {
        $registrant = Registrant::with('city')
            ->where('name', 'like', '%' . $data['name'] . '%')
            ->where('contact_no', 'like', '%' . $data['contact_no'] . '%')
            ->where('age', 'like', $data['age'] . '%')
            ->where('barangay', 'like', '%' . $data['barangay'] . '%')
            ->where('city_id', 'like', '%' . $data['city_id'] . '%')
            ->where('export_status', $data['export_status'])
            ->orderBy($data['orderByColumn'], $data['orderByDirection'])
            ->paginate(15);
        return $registrant;
    }

    public function getById($id)
    {
        return $this->registrant->firstWhere('id', $id);
    }

    public function save($data)
    {
        $registrant = new $this->registrant;

        $registrant->name          = ucwords(strtolower($data['name']));
        $registrant->birthday      = date('Y-m-d', strtotime($data['birthday']));
        $registrant->contact_no    = $data['contact_no'];
        $registrant->age           = $data['age'];
        $registrant->street        = $data['street'];
        $registrant->barangay      = $data['barangay'];
        $registrant->city_id       = $data['city_id'];
        $registrant->landmark      = $data['landmark'];
        $registrant->export_status = config('constants.defaults.export_status');

        $registrant->save();
        return $registrant->fresh();
    }

    public function update($data, $id)
    {
        $registrant = $this->registrant->find($id);

        $registrant->name        = ucwords(strtolower($data['name']));
        $registrant->birthday    = date('Y-m-d', strtotime($data['birthday']));
        $registrant->contact_no  = $data['contact_no'];
        $registrant->age         = $data['age'];
        $registrant->street      = $data['street'];
        $registrant->barangay    = $data['barangay'];
        $registrant->city_id     = $data['city_id'];
        $registrant->landmark    = $data['landmark'];

        $registrant->save();
        return $registrant;
    }

    public function delete($id)
    {
        $registrant = $this->registrant->find($id);
        $registrant->delete();

        return $registrant;
    }

    public function updateExportStatus($data)
    {
        return $this->registrant->whereIn('id', $data)->update(['export_status' => true]);
    }
}
