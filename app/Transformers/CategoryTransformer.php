<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Categories
*/
class CategoryTransformer extends TransformerAbstract
{
	public function transform(Category $category)
	{
		return[
		'id' => $category->id,
		'name' => $category->name
		];
	}
}