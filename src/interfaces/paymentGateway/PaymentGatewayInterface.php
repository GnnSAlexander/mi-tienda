<?php
namespace Src\Interfaces\PaymentGateway;

interface PaymentGatewayInterface
{
    function createTransaction($order);

    function getRequestInformation($requestId);
}