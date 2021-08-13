<?php

namespace Subsystem\SPA\Facades;

use Illuminate\Support\Facades\Facade;

class SPA extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'spa';
    }

}
