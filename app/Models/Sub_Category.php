<?php

namespace App\Models;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
	protected $table = 'sub_categories';
	protected $guarded = ['id'];
	protected $fillable = ['name', 'is_main', 'is_top', 'category_id'];

	public $timestamps = false;

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
