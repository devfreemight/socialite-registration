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
        'gender',
        'birthday',
        'contact_no',
        'age',
        'street',
        'barangay_id',
        'city_id',
        'landmark',
        'export_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'brgy_id' => 'string',
        'city_id' => 'string',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['barangay'];

    public function barangay()
    {
        return $this->hasOne('App\Barangay', 'brgy_id', 'barangay_id');
    }

    public function city()
    {
        return $this->hasOne('App\City', 'city_id', 'city_id');
    }
}
