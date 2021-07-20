<?php

namespace App\Providers;

use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\ServiceProvider;
use Src\Interfaces\PaymentGateway\PaymentGatewayInterface;
use Src\Implementation\PaymentGateway\PlaceToPayPaymentGateway;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGatewayInterface::class, function () {

            $service = new PlacetoPay([
                'login' => config('services.placetopay.login'),
                'tranKey' => config('services.placetopay.trankey'),
                'url' => config('services.placetopay.url'),
                'rest' => [
                    'timeout' => 60, // (optional) 15 by default
                    'connect_timeout' => 30, // (optional) 5 by default
                ]
            ]);

            return new PlaceToPayPaymentGateway($service);
        });

    }
}
