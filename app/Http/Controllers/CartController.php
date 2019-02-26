<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
	public function show(Cart $cart)
	{
		return new CartResource($cart);
	}

	public function store(Item $item)
	{
		return 0;
	}

	public function update(Cart $cart, Item $item)
	{
		return 0;
	}
}