<?php

namespace App\Http\Controllers\App;

class AdminAppController extends AppController
{
    public function appName() : string
    {
        return 'admin';
    }

    public function preload() : array
    {

    }
}
