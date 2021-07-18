<?php

namespace Tests\Feature;

use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SummaryModuleTest extends TestCase
{
    /**
     * Summary page loads with all data.
     *
     * @return void
     */
    public function testSummaryPageLoadsWithAllData()
    {
        $order = Order::latest()->first();

        $this->get(route('summary',['order'=> $order]))
            ->assertSee($order->customer_email)
            ->assertStatus(200);

    }
}
