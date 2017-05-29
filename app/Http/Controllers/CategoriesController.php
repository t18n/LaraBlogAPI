<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return fractal()
        ->collection($categories)
        ->parseIncludes(['subcategories'])
        ->transformWith(new CategoryTransformer)
        ->toArray();
    }

    public function find($id)
    {
        $category = Category::find($id);

        if(count($category)){
            return fractal()
            ->item($category)
            ->parseIncludes(['posts', 'subcategories'])
            ->transformWith(new CategoryTransformer)
            ->toArray();
        }
        else{
            return response()
            ->json(['status' => 'Category is not available or deleted!']);
        }
    }

    public function create(StoreCategoryRequest $request)
    {
        $category = new Category;
        $category->name = $request->name;

        if ($request->is_main == null)
            $category->is_main = 0;
        else
            $category->is_main = $request->is_main;

        if ($request->is_top == null)
            $category->is_top = 0;
        else
            $category->is_top = $request->is_top;

        $category->slug = Str::slug('category-' . $request->name, '-');

        $category->save();

        return fractal()
        ->item($category)
        ->transformWith(new CategoryTransformer)
        ->toArray();
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // If policy return true => authorized
        //This authorize only user who own the Category can edit it.
        //$this->authorize('update', $category);

        $category->name = $request->get('name', $category->name);
        $category->is_main = $request->get('is_main', $category->is_main);
        $category->is_top = $request->get('name', $category->is_top);

        $category->save();

        return fractal()
        ->item($category)
        ->transformWith(new CategoryTransformer)
        ->toArray();
    }

    public function delete(Category $category)
    {
        //$this->authorize('destroy', $category);
        $category->delete();

        $returnData = array(
            'status' => 'Deleted',
            'message' => $category->name . ' has been deleted'
            );

        return response()->json($returnData, 204);
    }
}
