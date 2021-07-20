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

        if($order->request_id){
            return redirect(route('order.show',['order'=> $order]));
        }


        $products = [new Product()];

        $urlToPayment = null;


        try{

            $response = $this->paymentGateway->createTransaction($order);

            if(is_array($response)){
                dd($response['error']->message());
            }

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

            if($order->status !== $response->status()->status()){

                if( in_array($response->status()->status(), $status) ){
                    $order->status = $response->status()->status();
                }

                if($response->status()->IsApproved() === 'APPROVED'){
                    $order->status = 'PAYED';
                }

                $order->save();
            }

            return redirect( route('order.show', [ 'order' => $order ]) );

        }catch (PlacetoPayException $exception){
                echo $exception->getMessage();
        }

    }
}
