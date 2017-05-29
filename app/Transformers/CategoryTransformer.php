<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Categories
*/
class CategoryTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['posts', 'subcategories'];

	public function transform(Category $category)
	{
		return[
			'id' => $category->id,
			'name' => $category->name,
			'slug' => $category->slug,
			'is_main' => $category->is_main,
			'is_top' => $category->is_top
			
		];
	}

	public function includePosts(Category $category)
	{
		return $this->collection(
			$category->posts, 
			new PostTransformer);
	}

	public function includeSubcategories(Category $category)
	{
		return $this->collection(
			$category->subcategories,
			new SubCategoryTransformer
			);
	}
}