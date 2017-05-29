<?php

namespace App\Transformers;

use App\Models\SubCategory;
use League\Fractal\TransformerAbstract;

class SubCategoryBriefTransformer extends TransformerAbstract
{
	public function transform(SubCategory $sub_category)
	{
		return[
			'name' => $sub_category->name
		];
	}
}