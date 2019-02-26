<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository implements CartRepositoryInterface
{
    protected $model;

    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}