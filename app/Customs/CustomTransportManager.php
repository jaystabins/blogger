<?php

namespace App\Customs;

use Illuminate\Mail\TransportManager;
use App\MailSetting; //my models are located in app\models

class CustomTransportManager extends TransportManager {

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;

        if( $settings = MailSetting::first() ){

            $this->app['config']['mail'] = [
                'driver'        => $settings->driver,
                'host'          => $settings->host,
                'port'          => $settings->port,
                'from'          => [
                        'address'   => $settings->from_address,
                        'name'      => $settings->from_name
                    ],
                'encryption'    => $settings->encryption,
                'username'      => $settings->username,
                'password'      => $settings->password,
                'pretend'       => false
           ];
       }

    }
}