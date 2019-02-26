<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Http\Resources\CartResource;
use App\Repositories\CartRepositoryInterface;

class CartController extends Controller
{
	protected $repository;

	public function __construct(CartRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function show(Cart $cart)
	{
		return new CartResource($cart);
	}

	public function store(Item $item)
	{
		$cart = $this->repository->create(['items' => [0 => $item]]);

		return new CartResource($cart);
	}

	public function update(Cart $cart, Item $item)
	{
		return 0;
	}
}