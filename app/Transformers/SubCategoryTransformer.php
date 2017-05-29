<?php

namespace App\Transformers;

use App\Models\SubCategory;
use League\Fractal\TransformerAbstract;

class SubCategoryTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['posts', 'category'];

	public function transform(SubCategory $subcategory)
	{
		return[
			'id' => $subcategory->id,
			'name' => $subcategory->name,
			'is_top' => $subcategory->is_top,
			'is_main' => $subcategory->is_main,
			'category_id' => $subcategory->category_id,
		];
	}


	public function includePosts(SubCategory $subcategory)
	{
		return $this->collection(
			$subcategory->posts, 
			new PostTransformer);
	}

	public function includeCategories(SubCategory $subcategory)
	{
		return $this->collection(
			$subcategory->categories, 
			new CategoryTransformer
			);
	}
}