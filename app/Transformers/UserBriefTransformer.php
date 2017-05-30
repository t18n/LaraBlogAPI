<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Tags
*/
class UserBriefTransformer extends TransformerAbstract
{
	public function transform(User $user)
	{
		return[
			'name' => $user->name,
			'slug' => $user->slug
		];
	}
}