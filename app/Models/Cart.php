<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	public function items()
	{
		return $this->belongsToMany(Item::class, 'carts_items')
					->withPivot('quantity')
					->withTimestamps();
	}
}