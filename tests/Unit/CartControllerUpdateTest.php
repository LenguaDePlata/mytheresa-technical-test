<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\CartController;
use App\Http\Resources\CartResource;
use App\Repositories\CartRepositoryInterface;
use App\Models\Item;
use App\Models\Cart;

class CartControllerUpdateTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $cartMock = $this->getCartMock();
        $repositoryMock = $this->getMockBuilder(CartRepositoryInterface::class)
                                ->disableOriginalConstructor()
                                ->getMock();
        $repositoryMock->method('update')
                        ->willReturn($cartMock);
        $this->controller = new CartController($repositoryMock);
    }

    public function testCartControllerUpdateResponseIsResource()
    {
        $itemMock = $this->getItemMock();
        $cartMock = $this->getCartMock();

        $this->assertInstanceOf(CartResource::class, $this->controller->update($cartMock, $itemMock));
    }

    protected function getItemMock()
    {
        $itemMock = $this->getMockBuilder(Item::class)
                        ->getMock();
        return $itemMock;
    }

    protected function getCartMock()
    {
        $cartMock = $this->getMockBuilder(Cart::class)
                        ->getMock();
        return $cartMock;
    }
}
