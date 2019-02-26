<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'items'
    ];

	public function items()
	{
		return $this->belongsToMany(Item::class, 'carts_items')
					->withPivot('quantity')
					->withTimestamps();
	}
}