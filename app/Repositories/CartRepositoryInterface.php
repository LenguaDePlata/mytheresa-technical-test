<?php

namespace App\Repositories;

use App\Models\Item;
use App\Models\Cart;

interface CartRepositoryInterface
{
    public function create(Item $item);
    public function update(Cart $cart, Item $item);
}