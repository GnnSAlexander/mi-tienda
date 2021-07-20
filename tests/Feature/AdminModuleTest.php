<?php

namespace Tests\Feature;

use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminModuleTest extends TestCase
{
    /**
     * It does not permission by code wrong.
     *
     * @return void
     */
    public function testItDoesNotPermissionByCodeWrong()
    {
        $this->get(route('admin'))
            ->assertSee('Doesn\'t have Permission')
            ->assertStatus(200);

        $this->get(route('admin',['code'=>'123'], false))
            ->assertSee('Doesn\'t have Permission')
            ->assertStatus(200);
    }

    /**
     * Permission valid by code correct.
     *
     * @return void
     */
    public function testPermissionValidByCodeCorrect()
    {
        $order = Order::first();
        $this->get(route('admin',['code'=> config('store.code')], false))
            ->assertSee('Admin')
            ->assertSee($order->customer_name)
            ->assertStatus(200);
    }
}
