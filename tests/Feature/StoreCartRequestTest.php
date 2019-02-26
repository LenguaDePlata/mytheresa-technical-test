<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Item;
use App\Http\Resources\ItemResource;

class StoreCartRequestTest extends TestCase
{
    use RefreshDatabase;

    public function testItemDoesNotExistResponse()
    {
        $response = $this->json('PUT', '/api/carts/item/1');

        $response->assertStatus(404)
                ->assertExactJson([
                    'error' => trans('apirest.errors.not_exists')
                ]);
    }

    public function testCreatedCartHasTheGivenItemAssociated()
    {
        $fakeItem = factory(Item::class)->create();
        $fakeResource = ItemResource::collection(collect([$fakeItem]));

        $response = $this->json('PUT', '/api/carts/item/1');

        $response->assertStatus(201)
                ->assertJson([
                    'data' => [
                        'items' => $fakeResource->resolve()
                    ]
                ]);
    }
}
