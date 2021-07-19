<?php

namespace App\Exports;

use App\Registrant;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegistrantExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registrant::all();
    }
}
