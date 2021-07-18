<?php

namespace Tests\Feature;

use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderModuleTest extends TestCase
{
    /**
     * Order page loads good.
     *
     * @return void
     */
    public function testOrderPageLoadsGood()
    {
        $this->get(route('order'))
            ->assertStatus(200);
    }

    /**
     * Check search method and its response is a JSON.
     *
     * @return void
     */
    public function testCheckSearchMethodAndResponseWithJson()
    {
        $order = factory(Order::class)->create();

        $response = $this->postJson(route('order.search'),['email'=> $order->customer_email]);

        //dd($response);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);

        // with email does not exist
        $response = $this->postJson(route('order.search'),['email'=> "example@ewewewe.com"]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'orders' =>  [],
            ]);


        //without email
        $response = $this->postJson(route('order.search'),['email'=> ""]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' =>  'error',
                'message' => 'The email is required'
            ]);
    }
}
