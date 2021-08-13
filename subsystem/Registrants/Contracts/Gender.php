<?php

namespace Subsystem\Registrants\Contracts;

interface Gender
{

    const FIELD = 'gender';
    const DEFAULT_VALUE = null;
    const MALE = 0;
    const FEMALE = 1;
    const DEFAULT_TEXT = '';
    const MALE_TEXT = 'male';
    const FEMALE_TEXT = 'female';

    const VALUES = [
        self::DEFAULT_VALUE,
        self::MALE,
        self::FEMALE,
    ];

    const TEXTS = [
        self::DEFAULT_VALUE => self::DEFAULT_TEXT,
        self::MALE => self::MALE_TEXT,
        self::FEMALE => self::FEMALE_TEXT
    ];


}
