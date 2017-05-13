<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $table = 'posts';
   protected $guarded = ['id'];
   protected $fillable = ['title', 'content', 'status', 'slug', 'recommends', 
   'rating', 'category_id', 'author_id', 'created_at', 'updated_at'];

   public function user()
   {
   		return $this->belongsTo(User::class);
   }

   public function tags()
   {
   		return $this->belongsToMany(Tag::class);
   }

      public function category()
   {
   		return $this->belongsTo(Category::class);
   }
}