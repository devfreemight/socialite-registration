<?php

namespace App\Exports;

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
        return \DB::table('registrants')
            ->join('cities', 'registrants.city_id', '=', 'cities.city_id')
            ->select('registrants.*', 'cities.name AS city')
            ->whereIn('registrants.id', $this->_ids)
            ->oldest('name')
            ->oldest('city')
            ->oldest('barangay')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
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
            $data->birthday,
            ' ' . $data->contact_no,
            $data->age,
            $data->street,
            $data->barangay,
            $data->city,
            $data->landmark,
        ];
    }

}
