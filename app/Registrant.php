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
}
