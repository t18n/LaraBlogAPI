<?php

namespace App\Transformers;

use App\Models\tag;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Tags
*/
class TagTransformer extends TransformerAbstract
{
	public function transform(Tag $tag)
	{
		return[
		'id' => $tag->id,
		'name' => $tag->name
		];
	}
}