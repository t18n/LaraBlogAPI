<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Tags
*/
class UserTransformer extends TransformerAbstract
{
	public function transform(User $user)
	{
		return[
		'id' => $user->id,
		'name' => $user->name,
		'email' => $user->email,
		'avatar' => $user->avatar(),
		'cover' => $user->cover,
		'birthday' => $user->birthday,
		'nickname' => $user->nickname,
		'occupation' => $user->occupation,
		'slug' => $user->slug,
		'address' => $user->address,
		'role_id' => $user->role_id,
		'created_at' => $user->created_at->diffForHumans(),
		'updated_at' => $user->updated_at->diffForHumans()
		];
	}
}