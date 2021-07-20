<?php
namespace Src\Interfaces;

interface PaymentGatewayInterface
{
    function createTransaction($order);

    function getRequestInformation($requestId);
}