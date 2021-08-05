<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Subsystem\Registrants\Traits\HasGender;

class Registrant extends Model
{
    use HasGender;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birthday',
        'contact_no',
        'age',
        'street',
        'barangay',
        'city_id',
        'landmark',
        'export_status',
    ];

    public function city()
    {
        return $this->hasOne('App\City', 'city_id', 'city_id');
    }
}
