<?php

namespace App\Transformers;

use App\Models\Sub_Category;
use League\Fractal\TransformerAbstract;

class SubCategoryBriefTransformer extends TransformerAbstract
{
	public function transform(Sub_Category $sub_category)
	{
		return[
			'name' => $sub_category->name
		];
	}
}