<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cart;
use App\Models\Item;
use App\Http\Resources\ItemResource;

class GetCartRequestTest extends TestCase
{
    use RefreshDatabase;

    public function testCartDoesNotExistResponse()
    {
        $response = $this->json('GET', '/api/carts/1');

        $response->assertStatus(404)
                ->assertExactJson([
                    'error' => trans('apirest.errors.not_exists')
                ]);
    }

    public function testEmptyCartResponse()
    {
        $fakeCart = factory(Cart::class)->create();
        
        $response = $this->json('GET', '/api/carts/1');

        $response->assertStatus(200)
                ->assertExactJson([
                    'data' => [
                        'id' => $fakeCart->id,
                        'items' => $fakeCart->items
                    ]
                ]);
    }

    public function testCartWithItemsResponse()
    {
        $fakeCart = factory(Cart::class)->create();
        $fakeCart->each(function ($cart) {
            $cart->items()->save(factory(Item::class)->create());
        });
        $fakeResource = ItemResource::collection($fakeCart->items);

        $response = $this->json('GET', '/api/carts/1');

        $response->assertStatus(200)
                ->assertExactJson([
                    'data' => [
                        'id' => $fakeCart->id,
                        'items' => $fakeResource
                    ]
                ]);
    }
}
