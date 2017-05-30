<?php

namespace App\Transformers;

use App\Models\Post;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Posts
*/
class PostTransformer extends TransformerAbstract
{
	protected $availableIncludes = [
		'user', 'category', 'sub_category', 'tags', 'likes'
	];

	public function transform(Post $post)
	{
		return[
		'id' => $post->id,
		'title' => $post->title,
		'content' => $post->content,
		'status' => $post->status,
		'slug' => $post->slug,
		'like_count' => $post->likes->count(),
		'view_count' => $post->view_count,
		//'sub_category_id' => $post->sub_category_id,
		//'category_id' => $post->category_id,
		'created_at' => $post->created_at->toDateTimeString(),
		'created_at_hr' => $post->created_at->diffForHumans(),
		'updated_at' => $post->updated_at->toDateTimeString(),
		'updated_at_hr' => $post->updated_at->diffForHumans()
		];
	}

	public function includeCategory(Post $post)
	{
		if($post->category != null)
		{
			return $this->item(
				$post->category,
				new CategoryBriefTransformer
				);
		}
	}

	public function includeSubcategory(Post $post)
	{
		if($post->sub_category_id != null)
		{
			return $this->item(
				$post->sub_category,
				new SubCategoryBriefTransformer
				);
		}
	}

	public function includeUser(Post $post)
	{
		if($post->user != null)
		{
			return $this->item(
				$post->user, 
				new UserBriefTransformer);
		}
	}

	public function includeTags(Post $post)
	{
		return $this->item($post->tag, new TagTransformer);
	}

	public function includeLikes(Post $post)
	{
		// Pluck method return a new collection with all the object specified.
		return $this->collection(
			$post->likes->pluck('user'), 
			new UserBriefTransformer);
	}
}