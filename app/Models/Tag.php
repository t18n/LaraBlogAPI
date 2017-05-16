<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $table = 'tags';
   	protected $guarded = ['id'];
   	protected $fillable = ['name'];


	public $timestamps = false;

	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}
}
