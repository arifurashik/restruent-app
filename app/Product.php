<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	// for solving mass assign error
	protected $guarded = [];

	public function types()
	{
		return $this->belongsTo(ProductType::class, 'type_id', 'id');
	}

	public function categories()
	{
		return $this->belongsTo(Category::class, 'cat_id', 'id');
	}


	public function get_image()
	{
		return $this->hasMany(Product_Image::class, 'product_id', 'id');
	}
}
