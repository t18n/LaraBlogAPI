<?php

namespace App\Transformers;

use App\Models\SubCategory;
use League\Fractal\TransformerAbstract;

class SubCategoryTransformer extends TransformerAbstract
{
	public function transform(SubCategory $subCategory)
	{
		return[
			'id' => $subCategory->id,
			'name' => $subCategory->name,
			'is_top' => $subCategory->is_top,
			'is_main' => $subCategory->is_main,
			'category_id' => $subCategory->category_id,
		];
	}
}