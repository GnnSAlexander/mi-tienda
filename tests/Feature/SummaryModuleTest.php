<?php

namespace Tests\Feature;

use App\Order;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SummaryModuleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Summary page loads with all data.
     *
     * @return void
     */
    public function testSummaryPageLoadsWithAllData()
    {
        $this->withoutExceptionHandling();
        $data = [
            'name' => 'Pepito Perez',
            'email' => 'example@example.com',
            'phone' => '1234567890',
            'total' => '175000',
            'currency' => 'COP'
        ];

        $response =  $this->from(route('checkout'))
            ->post(route('checkout.store'),$data);

        $lastId = DB::getPdo()->lastInsertId();
        $order = Order::find($lastId);

        $this->get(route('summary',['order'=> $order]))
            ->assertSee($order->customer_email)
            ->assertStatus(200);

    }
}
