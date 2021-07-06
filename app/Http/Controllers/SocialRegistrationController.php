<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialRegistrationController extends Controller
{
    protected $providers = [
        'facebook'
    ];

    protected $scopes = [
        'facebook' => [
            // user_birthday,
            // user_age_range,
            // user_gender,
        ]
    ];

    protected $fields = [
        'facebook' => [
            'name',
            'email',
            'gender',
            'birthday',
        ]
    ];

    private function isProviderAllowed($provider)
    {
        return in_array($provider, $this->providers) &&
                config()->has("services.{$provider}");
    }

    public function redirectProvider($provider, $city = null)
    {
        if ($this->isProviderAllowed($provider)) {
            session(['city_id' => $city]);

            return Socialite::driver($provider)
                ->scopes($this->scopes[$provider])
                ->fields($this->fields[$provider])
                ->redirect();
        }
        return redirect()->route('/');
    }

    public function registerWithProvider($provider, Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect()->route('user.registration');
        }

        try {
            $providerUser = Socialite::driver($provider)
                ->fields($this->fields[$provider])
                ->user();

            $user = \App\User::findByFacebookId($providerUser->id)->first();

            if ($user) {
                if ($provider == 'facebook') {
                    $user->facebook_id = $providerUser->id;
                    $user->save();
                }

                return redirect()->route('login');
            } else {
                $route = '/user/registration?';
                $route .= 'facebook_id=' . $providerUser->getId();
                $route .= '&name=' . $providerUser->getName();
                $route .= '&email=' . $providerUser->getEmail();

                if (isset($providerUser->user['gender'])) {
                    $route .= '&gender=' . $providerUser->user['gender'];
                }

                if (isset($providerUser->user['gender'])) {
                    $route .= '&birthday=' . $providerUser->user['birthday'];
                }

                $route .= '&city_id=' . $request->session()->pull('city_id');

                return redirect($route);
            }
        } catch (Exception $exception) {
            return redirect()->route('user.registration');
        }
    }
}
