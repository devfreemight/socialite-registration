<?php

namespace App\Http\Controllers\App;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

abstract class AppController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    abstract public function appName() : string;

    abstract public function preload() : array;

    public function getAppName()
    {
        return Str::upper($this->appName());
    }

    public function makeAppView()
    {
        $app_name = $this->getAppName();
        return view(\Str::lower("app.{$app_name}"));
    }

    public function makeAppToken()
    {
        return Crypt::encrypt($this->getAppName());
    }

    public function index()
    {
        view()->share('app_name', \View::shared('app_name', $this->getAppName()));
        view()->share('app_token', \View::shared('app_token', $this->makeAppToken()));
        return $this->makeAppView();
    }

    public function __invoke()
    {
        return $this->index();
    }

}
