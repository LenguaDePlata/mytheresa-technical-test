<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\CartController;
use App\Http\Resources\CartResource;
use App\Models\Cart;

class CartControllerShowTest extends TestCase
{
    protected $controller;

    protected function setUp()
    {
    	parent::setUp();
    	$this->controller = new CartController();
    }

    public function testCartControllerShowResponseType()
    {
    	$cartMock = $this->getMockBuilder(Cart::class)
    				->getMock();

    	$this->assertInstanceOf(CartResource::class, $this->controller->show($cartMock));
    }
}
