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

    function createTransaction($order)
    {

        $request = $this->requestFormat($order);

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

    protected  function requestFormat($order)
    {
        $request = [
            'buyer' =>[
                'name' => $order->customer_name,
                'email' => $order->customer_email,
                'mobile' => $order->customer_mobile
            ],
            'payment' => [
                'reference' => $order->id,
                'description' => 'Mi  Tienda',
                'amount' => [
                    'currency' => $order->currency,
                    'total' => $order->total,
                ],
            ],
            'expiration' => date('c', strtotime('+30 minutes')),
            'returnUrl' => route('summary.update',['order' => $order ]),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->server('HTTP_USER_AGENT'),
        ];

        return $request;
    }
}