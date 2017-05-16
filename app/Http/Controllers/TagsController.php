<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function find($id)
    {
        $tag = Tag::find($id);
        if(count($tag)){
            return response()->json($tag);
        }
        else{
            return response()
            ->json(['status' => 'Tag is not available or deleted!']);
        }
    }

    public function create(Request $request)
    {
        $tag = Tag::create($request->all());

        return response()->json($tag);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $update = $tag->update($request->all());

        return response()->json(['updated' => $tag]);
    }

    public function delete($id)
    {
        $count = Tag::destroy($id);

        return response()->json(['deleted' => $count == 1]);
    }
}
