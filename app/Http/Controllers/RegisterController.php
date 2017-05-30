<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function register(StoreUserRequest $request)
    {
    	$user = new User();

    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->birthday = $request->birthday;
    	$user->role_id = $request->role_id;
        $user->slug = Str::slug($request->name, '-') . '-' . Str::random(8);

    	$user->save();

        return fractal()
        ->item($user)
        ->transformWith(new UserTransformer)
        ->toArray();

    	//Todo: Send email activation
    }
}
