<?php

namespace App\Http\Controllers\App;

class GuestAppController extends AppController
{
    public function appName() : string
    {
        return 'guest';
    }

    public function preload() : array
    {

    }
}
