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

        $response = $this->services->request($request);
        if ($response->isSuccessful()) {

            return $response;

        } else {
            // There was some error so check the message and log it
            return [ 'error' => $response->status() ];
        }

    }

    function getRequestInformation($requestId)
    {
        return $this->services->query($requestId);

    }
}