<?php
namespace Src\Interfaces;

use Dnetix\Redirection\PlacetoPay;

class PlaceToPayPaymentGateway implements PaymentGatewayInterface
{
    protected $services;

    function __construct(PlacetoPay $services)
    {
        $this->services = $services;
    }

    function processURL($request)
    {
        /*$reference = '1';
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
];*/

        $response = $this->services->request($request);
        if ($response->isSuccessful()) {
            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            // Redirect the client to the processUrl or display it on the JS extension
            return $response;

        } else {
            // There was some error so check the message and log it
            return [ 'error' => $response->status() ];
        }
        return ;
    }

    function getRequestInformation($requestId)
    {
        return $this->services->query($requestId);

    }
}