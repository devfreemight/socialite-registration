<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brgy_id', 'name', 'region_code', 'province_code', 'city_id'
    ];
}
