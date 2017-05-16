<?php

namespace App\Transformers;

use App\Models\Post;
use App\Models\Category;
use League\Fractal\TransformerAbstract;

/**
* This class is the transformer for Posts
*/
class PostTransformer extends TransformerAbstract
{
	protected $availableIncludes = [
	'category'
	];

	public function transform(Post $post)
	{
		return[
		'id' => $post->id,
		'title' => $post->title,
		'content' => $post->content,
		'status' => $post->status,
		'slug' => $post->slug,
		'recommends' => $post->recommends,
		'rating' => $post->rating,
		'category_id' => $post->category_id,
		'author_id' => $post->author_id,
		'created_at' => $post->created_at->diffForHumans(),
		'updated_at' => $post->updated_at->diffForHumans()
		];
	}

	public function includeCategory(Post $post)
	{
		return $this->item($post->category, new CategoryTransformer);
	}

	public function includeTags(Post $post)
	{
		return $this->item($post->tag, new CategoryTransformer);
	}
}