<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Posts
*/
class PostTransformer extends TransformerAbstract
{
	protected $availableIncludes = [
		'category', 'user'
	];

	public function transform(Post $post)
	{
		return[
		'id' => $post->id,
		'title' => $post->title,
		'content' => $post->content,
		'status' => $post->status,
		'slug' => $post->slug,
		'seed' => $post->seed,
		'rating' => $post->rating,
		'view_count' => $post->view_count,
		'category_id' => $post->category_id,
		'sub_category_id' => $post->sub_category_id,
		'user_id' => $post->user_id,
		'created_at' => $post->created_at->toDateTimeString(),
		'created_at_hr' => $post->created_at->diffForHumans(),
		'updated_at' => $post->updated_at->toDateTimeString(),
		'updated_at_hr' => $post->updated_at->diffForHumans()
		];
	}

	public function includeCategory(Post $post)
	{
		return $this->item($post->category, new CategoryBriefTransformer);
	}

	public function includeSubCategory(Post $post)
	{
		return $this->item($post->category, new SubCategoryBriefTransformer);
	}

	public function includeTags(Post $post)
	{
		return $this->item($post->tag, new TagTransformer);
	}

	public function includeUser(Post $post)
	{
		return $this->item($post->user, new UserBriefTransformer);
	}
}