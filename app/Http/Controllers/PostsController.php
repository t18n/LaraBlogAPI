<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostSlugBuilder;
use App\Http\Controllers\Controller;
use App\Transformers\PostTransformer;

class PostsController extends Controller
{
    public function index(Post $post)
    {
        // $posts = Post::all();
        // return response()->json($posts);
        return fractal()
        ->collection($post->get())
        ->transformWith(new PostTransformer)
        ->includeCategory()
        ->toArray();
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
