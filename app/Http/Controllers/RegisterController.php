<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\User;


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

    	$user->save();

    	//Todo: Send email activation
    }

}
