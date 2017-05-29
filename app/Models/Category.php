<?php

namespace App\Models;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use Orderable;

	protected $table = 'categories';
	protected $guarded = ['id'];
	protected $fillable = ['name', 'is_main', 'is_top'];

	public $timestamps = false;

	public function posts()
	{
		return $this->hasMany(Post::class)->latestFirst();
	}

	public function subCategories()
	{
		return $this->hasMany(SubCategory::class);
	}
}
