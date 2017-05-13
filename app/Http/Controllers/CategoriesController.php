<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }

    public function find($id)
    {
        $category = Category::find($id);
        if(count($category)){
            return response()->json($category);
        }
        else{
            return response()
            ->json(['status' => 'Category is not available or deleted!']);
        }
    }

    public function create(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $update = $category->update($request->all());

        return response()->json(['updated' => $category]);
    }

    public function delete($id)
    {
        $count = Category::destroy($id);

        return response()->json(['deleted' => $count == 1]);
    }
}
