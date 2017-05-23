<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Transformers\CategoryTransformer;

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
        // $category = Category::create($request->all());
        // return response()->json($category);

        $category = new Category;
        $category->name = $request->name;

        $category->save();

        return fractal()
            ->item($category)
            ->transformWith(new CategoryTransformer)
            ->toArray();
    }

    public function update(StoreCategoryRequest $request, $id)
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
