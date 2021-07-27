<?php

namespace App\Exports;

use App\Registrant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class RegistrantExport implements FromCollection, WithMapping, WithHeadings
{
    private $_ids;

    public function __construct(array $ids)
    {
        $this->_ids = $ids;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registrant::whereIn('id', $this->_ids)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Gender',
            'Birthday',
            'Contact No.',
            'Age',
            'Street',
            'Barangay',
            'City',
            'Landmark',
        ];
    }

    public function map($data): array
    {
        return [
            $data->name,
            ucfirst($data->gender_text),
            $data->birthday,
            $data->contact_no,
            $data->age,
            $data->street,
            $data->barangay->name,
            $data->city->name,
            $data->landmark,
        ];
    }

}
