<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
    'name', 'email', 'password',
    ];

    protected $hidden = [
    'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // public static function emailExist($email)
    // {
    //     return static::whereEmail($email)->first();
    // }

    public function ownsPost(Post $post)
    {
        return $this->id === $post->user->id;
    }

    public function avatar()
    {
        $size = 70;
        return 'https://gravatar.com/avatar/'. 
                md5($this->email) . 
                '?s='. $size . 
                '&d=mm';
    }
}
