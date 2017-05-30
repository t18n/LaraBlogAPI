<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\SubCategory;
use App\Transformers\PostTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latestFirst()->get();

        return fractal()
        ->collection($posts)
        ->parseIncludes([ 'user', 'category', 'sub_category', 'likes' ])
        ->transformWith(new PostTransformer)
        ->toArray();
    }

    public function find($id)
    {
        $post = Post::find($id);

        if(count($post)){
            return fractal()
            ->item($post)
            ->parseIncludes([
             'user', 'category', 'sub_category', 'likes'  
             ])
            ->transformWith(new PostTransformer)
            ->toArray();
        }
        else{
            return response()->json([
                'data' => [
                    'status' => 'Post is not available or deleted!']
                ], 404);
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

        if ($request->sub_category_id != 0 && $request->category_id == null)
        {
            $post->sub_category()->associate($request->sub_category_id);
            $post->category()->associate($post->sub_category->category_id);
        }
        else if($request->sub_category_id != 0 && $request->category_id != 0)
        {
            $sub_category = SubCategory::find($request->sub_category_id);

            if($sub_category->category_id != $request->category_id)
            {
                 return response()->json([
                'data' => [
                    'status' => 'Category does not match Sub Category']
                ], 404);
            }
            else{
                $post->sub_category()->associate($request->sub_category_id);
                $post->category()->associate($sub_category->category_id);
            }
        } 
        else if ($request->category_id != 0 && $request->sub_category_id == null)
        {
            return response()->json([
                'data' => [
                    'status' => 'Please explicit a specific Sub Category']
                ], 404);
        }

        $post->user()->associate($request->user_id);

        if(empty($request->created_at))
            $post->created_at = Carbon::now();
        else
         $post->created_at = $request->created_at;

     $post->updated_at = Carbon::now();

     $post->save();

     return fractal()
     ->item($post)
     ->transformWith(new PostTransformer)
     ->toArray();
 }

 public function update(UpdatePostRequest $request, Post $post)
 {
        // If policy return true => authorized
        //This authorize only user who own the post can edit it.
    $this->authorize('update', $post);

    $post->title = $request->get('title', $post->title);
    $post->content = $request->get('content', $post->content);
    $post->status = $request->get('status', $post->status);
    $post->view_count = $request->get('view_count', $post->view_count);
    $post->seed = $request->get('seed', $post->seed);
    $post->slug = $request->get('slug', $post->slug);
    $post->rating = $request->get('rating', $post->rating);
    $post->user_id = $request->get('user_id', $post->user_id);
    $post->category_id = $request->get('category_id', $post->category_id);
    $post->sub_category_id = $request->get('sub_category_id', $post->sub_category_id);


    if ($request->sub_category_id != 0)
    {
        $post->sub_category_id = $request->sub_category_id;
        //$post->category_id = $post->sub_category()->category_id;
    }
    else if($request->category_id != 0)
    {
        $post->category_id = $request->category_id;
        $post->sub_category_id = null;
    }
    else
    {
        $post->category_id = $request->get('category_id', $post->category_id);
        $post->sub_category_id = $request->get('sub_category_id', $post->sub_category_id);
    }

    $post->created_at = $request->get('created_at', $post->created_at);
    $post->updated_at = Carbon::now();

    $post->save();

    return fractal()
    ->item($post)
    ->transformWith(new PostTransformer)
    ->toArray();
}

public function delete(Post $post)
{
    $this->authorize('destroy', $post);

    $post->delete();

    $returnData = array(
        'status' => 'Deleted',
        'message' => $post->title . ' has been deleted'
        );

    return response()->json($returnData, 404);
}

}
