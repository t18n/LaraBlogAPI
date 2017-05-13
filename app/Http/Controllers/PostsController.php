<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Services\PostSlugBuilder;


class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function find($id)
    {
        $post = Post::find($id);
        if(count($post)){
            return response()->json($post);
        }
        else{
            return response()
            ->json(['status' => 'Post is not available or deleted!']);
        }
    }

    public function create(Request $request)
    {
        $post = Post::create($request->all());

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $update = $post->update($request->all());

        return response()->json(['updated' => $post]);
    }

    public function delete($id)
    {
        $count = Post::destroy($id);

        return response()->json(['deleted' => $count == 1]);
    }
}
