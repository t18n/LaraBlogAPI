<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Categories
*/
class CategoryTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['posts'];

	public function transform(Category $category)
	{
		return[
			'id' => $category->id,
			'name' => $category->name
		];
	}

	public function includePosts(Category $category)
	{
		return $this->collection($category->posts, new PostTransformer);
	}
}