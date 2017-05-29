<?php

namespace App\Transformers;

use App\Models\Sub_Category;
use League\Fractal\TransformerAbstract;

class SubCategoryTransformer extends TransformerAbstract
{
	public function transform(Sub_Category $sub_category)
	{
		return[
			'id' => $sub_category->id,
			'name' => $sub_category->name,
			'is_top' => $sub_category->is_top,
			'is_main' => $sub_category->is_main,
			'category_id' => $sub_category->category_id,
		];
	}
}