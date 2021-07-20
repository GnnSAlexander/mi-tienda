<?php

namespace Tests\Feature;

use App\Order;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutModuleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Verify it loads the checkout page
     *
     * @return void
     */
    public function  testItLoadsTheCheckoutPage()
    {

        $this->get(route('checkout'))
            ->assertSee('Billing Information')
            ->assertStatus(200);

    }

    /**
     * Verify The name is Required
     *
     * @return void
     */

    public function testTheNameIsRequired()
    {
        //$this->withoutExceptionHandling();
        $data = [
            'name' => '',
            'email' => 'example@example.com',
            'phone' => '12345678'
        ];

        $this->from(route('checkout'))
            ->post(route('checkout.store'),$data)
            ->assertRedirect(route('checkout'))
            ->assertSessionHasErrors(['name']);


        $data['name'] = 'te';

        $this->from(route('checkout'))
            ->post(route('checkout.store'),$data)
            ->assertRedirect(route('checkout'))
            ->assertSessionHasErrors(['name']);
    }

    /**
     * Verify The email is Required
     *
     * @return void
     */

    public function testTheEmailIsRequired()
    {
        //$this->withoutExceptionHandling();
        $data = [
            'name' => 'Pepito Perez',
            'email' => '',
            'phone' => '12345678'
        ];

        $this->from(route('checkout'))
            ->post(route('checkout.store'),$data)
            ->assertRedirect(route('checkout'))
            ->assertSessionHasErrors(['email']);


        $data['email'] = 'email-no-valid';

        $this->from(route('checkout'))
            ->post(route('checkout.store'),$data)
            ->assertRedirect(route('checkout'))
            ->assertSessionHasErrors(['email']);
    }

    /**
     * Verify The phone is Required
     *
     * @return void
     */

    public function testPhoneIsRequired()
    {
        //$this->withoutExceptionHandling();
        $data = [
            'name' => 'Pepito Perez',
            'email' => 'example@example.com',
            'phone' => '',
            'total' => '175000',
            'currency' => 'COP'
        ];

        $this->from(route('checkout'))
            ->post(route('checkout.store'),$data)
            ->assertRedirect(route('checkout'))
            ->assertSessionHasErrors(['phone']);


        $data['phone'] = 'te';

        $this->from(route('checkout'))
            ->post(route('checkout.store'),$data)
            ->assertRedirect(route('checkout'))
            ->assertSessionHasErrors(['phone']);
    }

    /**
     * Verify the order is created
     *
     * @return void
     */

    public function testTheOrderIsCreated()
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

        $response->assertRedirect(route('summary',['order' => $lastId]));
        $this->get(route('summary',['order' => $lastId]))->assertSee('Pay');

        $order = $this->assertDatabaseHas('orders',[
            'customer_name' => 'Pepito Perez',
            'customer_email' => 'example@example.com',
            'customer_mobile' => '1234567890'
        ]);

    }

    /**
     * Fill an order with order rejected
     *
     * @return void
     */

    public function testFillAnOrderWithOrderRejected()
    {
        //$this->withoutExceptionHandling();

        $orderStatus = config('store.order_status');

        factory(Order::class,10)->create();

        $order = Order::where('status', $orderStatus[103])->first();

        $this->get(route('checkout',['order' => $order]))
            ->assertStatus(200)
            ->assertSee($order->customer_name)
            ->assertSee($order->customer_email)
            ->assertSee($order->customer_mobile);
    }

}
