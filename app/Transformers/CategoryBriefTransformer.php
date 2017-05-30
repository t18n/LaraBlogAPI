<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryBriefTransformer extends TransformerAbstract
{
	public function transform(Category $category)
	{
		return[
			'name' => $category->name,
			'slug' => $category->slug,
		];
	}
}