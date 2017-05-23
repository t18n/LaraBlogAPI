<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Orderable;

class Category extends Model
{
	use Orderable;

	protected $table = 'categories';
	protected $guarded = ['id'];
	protected $fillable = ['name'];

	public $timestamps = false;

	public function posts()
	{
		return $this->hasMany(Post::class)->latestFirst();
	}
}
