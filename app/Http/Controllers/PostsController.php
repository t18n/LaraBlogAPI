<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Transformers\PostTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        //$posts = Post::latestFirst()->get();
        $posts = Post::get();

        return fractal()
        ->collection($posts)
        ->parseIncludes(['category', 'user'])
        ->transformWith(new PostTransformer)
        ->toArray();
    }

    public function find($id)
    {
        $post = Post::find($id);

        if(count($post)){
            return fractal()
            ->item($post)
            ->parseIncludes(['category', 'user'])
            ->transformWith(new PostTransformer)
            ->toArray();
        }
        else{
            return response()
            ->json(['status' => 'Post is not available or deleted!']);
        }
        
    }

    public function create(StorePostRequest $request)
    {
        // $post = Post::create($request->all());
        // return response()->json($post);
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;
        $post->slug = Str::slug($request->title, '-');
        $post->view_count = $request->view_count;
        $post->seed = $request->seed;
        $post->rating = $request->rating;
        $post->category()->associate($request->category_id);
        $post->user()->associate($request->user_id);
        $post->created_at = $request->created_at;
        $post->updated_at = $request->updated_at;

        $post->save();

        return fractal()
        ->item($post)
        ->transformWith(new PostTransformer)
        ->toArray();
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);

        // If policy return true => authorized
        //This authorize only user who own the post can edit it.
        $this->authorize('update', $post);

        $post->title = $request->get('title', $post->title);
        $post->content = $request->get('content', $post->content);
        $post->status = $request->get('status', $post->status);
        $post->view_count = $request->get('view_count', $post->view_count);
        $post->seed = $request->get('seed', $post->seed);
        $post->rating = $request->get('rating', $post->rating);
        $post->user_id = $request->get('user_id', $post->user_id);
        $post->category_id = $request->get('category_id', $post->category_id);
        $post->created_at = $request->get('created_at', $post->created_at);
        $post->updated_at = Carbon::now();

        $post->save();

        return fractal()
        ->item($post)
        ->transformWith(new PostTransformer)
        ->toArray();
    }

    public function delete($id)
    {
        $post = Post::find($id);
        //$count = Post::destroy($id);

        // If policy return true => authorized
        //This authorize only user who own the post can edit it.
        //$this->authorize('destroy', $post);
        $post->delete();

        //return response()->json(['deleted' => $count == 1]);
        return response(null, 204);
    }
}
