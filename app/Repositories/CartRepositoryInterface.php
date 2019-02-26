<?php

namespace App\Repositories;

use App\Models\Item;

interface CartRepositoryInterface
{
    public function create(Item $item);
}