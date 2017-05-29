<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Sub_Category;
use App\Models\Tag;
use App\Models\User;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   use Orderable;

   protected $table = 'posts';
   protected $guarded = ['id'];
   protected $fillable = ['title', 'content', 'status', 'slug', 'seed', 'rating', 'category_id', 'sub_category_id', 'user_id', 'view_count', 'created_at', 'updated_at'];

   public function user()
   {
     return $this->belongsTo(User::class);
  }
  
  public function category()
  {
     return $this->belongsTo(Category::class);
  }

  public function sub_category()
  {
     return $this->belongsTo(Sub_Category::class);
  }

  public function tags()
  {
     return $this->belongsToMany(Tag::class);
  }
}