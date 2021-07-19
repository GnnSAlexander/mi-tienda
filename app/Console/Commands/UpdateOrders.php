<?php

namespace App\Console\Commands;

use App\Order;
use Illuminate\Console\Command;
use Src\Interfaces\PaymentGatewayInterface;

class UpdateOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:orders';

    protected $services;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Orders that have the status CREATED or PENDING';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PaymentGatewayInterface $services)
    {
        parent::__construct();

        $this->services = $services;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $status = config('store.order_status');

        $orders =Order::whereIn('status', ['CREATED', 'PENDING'])->get();

        foreach ($orders as $order){
            if($order->request_id){
                $response = $this->services->getRequestInformation( $order->request_id);

                if($response->status()->status() !== $order->status){
                    if( in_array($response->status()->status(), $status) ){
                        $order->status = $response->status()->status();
                    }

                    if($response->status()->status() === 'APPROVED'){
                        $order->status = 'PAYED';
                    }

                    $order->save();
                }
            }
        }
    }
}
