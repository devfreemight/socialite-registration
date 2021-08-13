<?php
namespace Subsystem\SPA\Impl;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Str;

class SPA {
    use Macroable;

    public function appName()
    {
        $app = $this->getAppNameFromHeader();
        return Str::upper(empty($app) ?  $this->defaultApp() : $app);
    }

    public function getAppNameFromHeader()
    {
        $token = request()->header('X-APP-TOKEN');
        if( strlen($token) > 180 && !is_numeric($token)){
            try {
                $decrypted = \Crypt::decrypt($token);
                return $decrypted;
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                throw new \Illuminate\Auth\AuthenticationException( 'Unauthenticated application', []);
            }
        }
        return $token;
    }

    public function defaultApp()
    {
        return 'guest';
    }

}

