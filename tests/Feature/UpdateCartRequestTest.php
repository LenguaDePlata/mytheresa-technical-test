<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\ItemResource;
use App\Models\Cart;
use App\Models\Item;

class UpdateCartRequestTest extends TestCase
{
    use RefreshDatabase;

    public function testItemDoesNotExistResponse()
    {
        $fakeCart = $this->getFakeCart();
        $response = $this->json('PUT', '/api/carts/'.$fakeCart->id.'/item/1');

        $response->assertStatus(404)
                ->assertExactJson([
                    'error' => trans('apirest.errors.not_exists')
                ]);
    }

    public function testCartDoesNotExistResponse()
    {
        $fakeItem = factory(Item::class)->create();
        $response = $this->json('PUT', '/api/carts/1/item/'.$fakeItem->id);

        $response->assertStatus(404)
                ->assertExactJson([
                    'error' => trans('apirest.errors.not_exists')
                ]);
    }

    public function testNeitherCartNorItemExistResponse()
    {
        $response = $this->json('PUT', '/api/carts/1/item/1');

        $response->assertStatus(404)
                ->assertExactJson([
                    'error' => trans('apirest.errors.not_exists')
                ]);
    }

    public function testAddingAnItemToAnEmptyCartResponse()
    {
        $fakeCart = $this->getFakeCart();
        $fakeItem = factory(Item::class)->create();
        $fakeResource = ItemResource::collection(collect([$fakeItem]));

        $response = $this->json('PUT', '/api/carts/'.$fakeCart->id.'/item/'.$fakeItem->id);

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'id' => $fakeCart->id,
                        'items' => $fakeResource->resolve()
                    ]
                ])
                ->assertJsonFragment([
                    'quantity' => "1"
                ]);
    }

    public function testAddingAnotherItemToANonEmptyCartResponse()
    {
        $fakeExistingItem = factory(Item::class)->create();
        $fakeCart = $this->getFakeCart($fakeExistingItem);

        $fakeNewItem = factory(Item::class)->create();

        $response = $this->json('PUT', '/api/carts/'.$fakeCart->id.'/item/'.$fakeNewItem->id);

        $response->assertStatus(200)
                ->assertExactJson([
                    'data' => [
                        'id' => $fakeCart->id,
                        'items' => [
                            [
                                'id' => $fakeExistingItem->id,
                                'name' => $fakeExistingItem->name,
                                'price' => strval($fakeExistingItem->price),
                                'quantity' => "1"
                            ],
                            [
                                'id' => $fakeNewItem->id,
                                'name' => $fakeNewItem->name,
                                'price' => strval($fakeNewItem->price),
                                'quantity' => "1"
                            ]
                        ]
                    ]
                ]);
    }

    public function testAddingItemAgainToCartResponse()
    {
        $fakeItem = factory(Item::class)->create();
        $fakeCart = $this->getFakeCart($fakeItem);

        $response = $this->json('PUT', '/api/carts/'.$fakeCart->id.'/item/'.$fakeItem->id);

        $response->assertStatus(200)
                ->assertExactJson([
                    'data' => [
                        'id' => $fakeCart->id,
                        'items' => [
                            [
                                'id' => $fakeItem->id,
                                'name' => $fakeItem->name,
                                'price' => strval($fakeItem->price),
                                'quantity' => "2"
                            ]
                        ]
                    ]
                ]);
    }

    protected function getFakeCart(Item $item = null)
    {
        $fakeCart = factory(Cart::class)->create();
        if (!is_null($item)) {
            $fakeCart->items()->attach($item);
        }

        return $fakeCart;
    }
}
