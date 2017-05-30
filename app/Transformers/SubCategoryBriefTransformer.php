<?php

namespace App\Transformers;

use App\Models\SubCategory;
use League\Fractal\TransformerAbstract;

class SubCategoryBriefTransformer extends TransformerAbstract
{
	public function transform(SubCategory $subcategory)
	{
		return[
			'name' => $subcategory->name,
			'slug' => $subcategory->slug
		];
	}
}