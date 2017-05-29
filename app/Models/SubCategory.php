<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Post;
use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
	use Orderable;
	
	protected $table = 'sub_categories';
	protected $guarded = ['id'];
	protected $fillable = ['name', 'is_main', 'is_top', 'category_id'];

	public $timestamps = false;

	public function posts()
	{
		return $this->hasMany(Post::class)->latestFirst();
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
