<?php
namespace Src\Interfaces;

interface PaymentGatewayInterface
{
    function processURL($request);

    function getRequestInformation($requestId);
}