<?php

namespace App\Http\Controllers;

use App\Order;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Illuminate\Http\Request;
use Src\Interfaces\PaymentGatewayInterface;
use Src\Models\Product;

class SummaryController extends Controller
{
    protected $paymentGateway;

    function __construct(PaymentGatewayInterface $paymentGateway )
    {
        $this->paymentGateway = $paymentGateway;
    }

    function index(Order $order)
    {
        $products = [new Product()];

        $urlToPayment = null;

        $data = [
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
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => route('summary.update',['order' => $order ]),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->server('HTTP_USER_AGENT'),
        ];

        try{

            $response = $this->paymentGateway->processURL($data);

            if($response->isSuccessful()){

                $order->request_id = $response->requestId();
                $order->save();

                $urlToPayment = $response->processUrl();

            }else{
                echo $response->status()->message();
            }


        }catch (PlacetoPayException $exception){
            echo $exception->getMessage();
        }

        return view('summary.index',compact(['order', 'products','urlToPayment']));
    }

    public function update(Order $order)
    {
        try{
            $response = $this->paymentGateway->getRequestInformation($order->request_id);

            $status = config('store.order_status');

            $order->status = $response->status()->status();

            $order->save();

            return redirect( route('order.show', [ 'order' => $order ]) );

        }catch (PlacetoPayException $exception){
                echo $exception->getMessage();
        }

    }
}
