<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Item;

class CartRepository implements CartRepositoryInterface
{
    protected $model;

    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    public function create(Item $item)
    {
        $cart = $this->model->create();
        $cart->items()->attach($item);
        // $cart->save();

        return $cart;
    }

    public function update(Cart $cart, Item $item)
    {
        $cart->items()->attach($item);

        return $cart;
    }
}