<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
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
    protected $with = ['barangay', 'city'];

    public function barangay()
    {
        return $this->hasOne('App\Barangay', 'brgy_id', 'barangay_id');
    }

    public function city()
    {
        return $this->hasOne('App\City', 'city_id', 'city_id');
    }
}
