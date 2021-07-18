<?php

namespace Tests\Unit;

use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\PlacetoPay;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaceToPlayTest extends TestCase
{
    /**
     * Check the configurations of place to pay.
     *
     * @return void
     */
    public function testCheckTheConfigurationOfPlaceToPayToFailed()
    {
        $config = [
            'login' => 'WRONG',
            'tranKey' => config('services.placetopay.trankey'),
            'url' => config('services.placetopay.url'),
            'rest' => [
                'timeout' => 60, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ];

        //unset($config['login']);

        //Request

        $reference = '1';
        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Mi  Tienda',
                'amount' => [
                    'currency' => 'COP',
                    'total' => 120000,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://mi-tienda.test/?reference=' . $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        try{
            $placetopay = new PlacetoPay($config);

            $response = $placetopay->request($request);

            dd($response->status()->message());

        }catch (PlacetoPayException $exception){

            $this->assertEquals('No login or tranKey provided on gateway', $exception->getMessage());
        }


    }

    /**
     * Check creation a new pay session
     *
     * @return void
     */
    public function testCheckCreationANewPaySession()
    {
        $config = [
            'login' => config('services.placetopay.login'),
            'tranKey' => config('services.placetopay.trankey'),
            'url' => config('services.placetopay.url'),
            'rest' => [
                'timeout' => 60, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ];

        //Request

        $reference = '1';
        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Mi  Tienda',
                'amount' => [
                    'currency' => 'COP',
                    'total' => 120000,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://mi-tienda.test/?reference=' . $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        $placetopay = new PlacetoPay($config);

        $response = $placetopay->request($request);

        $this->assertTrue($response->isSuccessful());


    }
}
