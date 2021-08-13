<?php

namespace Subsystem\Registrants\Traits;

use Subsystem\Registrants\Contracts\Gender;

trait HasGender
{


    public function initializeHasGender()
    {
        $this->fillable [] = Gender::FIELD;
    }

    public function getGenderTextAttribute()
    {
        return Gender::TEXTS[$this->gender];
    }

    public function getIsFemaleAttribute()
    {
        return $this->gender == Gender::FEMALE;
    }

    public function getIsMaleAttribute()
    {
        return $this->gender == Gender::MALE;
    }

    public function scopeMales($query)
    {
        return $query->where(Gender::FIELD, Gender::MALE );
    }

    public function scopeFemales($query)
    {
        return $query->where(Gender::FIELD, Gender::FEMALE );
    }

}


