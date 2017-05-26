<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Categories
*/
class CategoryBriefTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['posts'];

	public function transform(Category $category)
	{
		return[
			'name' => $category->name
		];
	}

	public function includePosts(Category $category)
	{
		return $this->collection($category->posts, new PostTransformer);
	}
}