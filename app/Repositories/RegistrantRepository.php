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
        $registrant = Registrant::where('name', 'like', '%' . $data['name'] . '%')
            ->where('gender', 'like', $data['gender'] . '%')
            ->where('contact_no', 'like', '%' . $data['contact_no'] . '%')
            ->where('age', 'like', $data['age'] . '%')
            ->where('barangay_id', 'like', $data['barangay_id'] . '%')
            ->where('city_id', config('constants.defaults.city.id'))
            ->where('export_status', $data['export_status'])
            ->oldest('name')
            ->oldest('age')
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

        $registrant->name          = $data['name'];
        $registrant->gender        = $data['gender'];
        $registrant->birthday      = date('Y-m-d', strtotime($data['birthday']));
        $registrant->contact_no    = $data['contact_no'];
        $registrant->age           = $data['age'];
        $registrant->street        = $data['street'];
        $registrant->barangay_id   = $data['barangay_id'];
        $registrant->city_id       = config('constants.defaults.city.id');
        $registrant->landmark      = $data['landmark'];
        $registrant->export_status = config('constants.defaults.export_status');

        $registrant->save();
        return $registrant->fresh();
    }

    public function update($data, $id)
    {
        $registrant = $this->registrant->find($id);

        $registrant->name        = $data['name'];
        $registrant->gender      = $data['gender'];
        $registrant->birthday    = date('Y-m-d', strtotime($data['birthday']));
        $registrant->contact_no  = $data['contact_no'];
        $registrant->age         = $data['age'];
        $registrant->street      = $data['street'];
        $registrant->barangay_id = $data['barangay_id'];
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
