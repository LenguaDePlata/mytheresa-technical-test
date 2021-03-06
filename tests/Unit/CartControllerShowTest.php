<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\CartController;
use App\Http\Resources\CartResource;
use App\Repositories\CartRepositoryInterface;
use App\Models\Cart;

class CartControllerShowTest extends TestCase
{
    protected $controller;

    protected function setUp()
    {
    	parent::setUp();
        $repositoryMock = $this->getMockBuilder(CartRepositoryInterface::class)
                                ->disableOriginalConstructor()
                                ->getMock();

    	$this->controller = new CartController($repositoryMock);
    }

    public function testCartControllerShowResponseIsResource()
    {
    	$cartMock = $this->getCartMock();

    	$this->assertInstanceOf(CartResource::class, $this->controller->show($cartMock));
    }

    protected function getCartMock()
    {
        $cartMock = $this->getMockBuilder(Cart::class)
                        ->getMock();
        return $cartMock;
    }
}
