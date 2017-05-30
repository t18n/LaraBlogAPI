<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\SubCategory;
use App\Transformers\SubCategoryTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::get();

        return fractal()
        ->collection($subcategories)
        ->parseIncludes(['posts', 'category'])
        ->transformWith(new SubCategoryTransformer)
        ->toArray();
    }

    public function find($id)
    {
        $subcategories = SubCategory::find($id);

        if(count($subcategories)){
            return fractal()
            ->item($subcategories)
            ->parseIncludes(['posts', 'category'])
            ->transformWith(new SubCategoryTransformer)
            ->toArray();
        }
        else{
            return response()
            ->json(['status' => 'SubCategory is not available or deleted!']);
        }
    }

    public function create(StoreSubCategoryRequest $request)
    {
        $subcategory = new SubCategory;

        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;

        if ($request->is_main == null)
            $subcategory->is_main = 0;
        else
            $subcategory->is_main = $request->is_main;

        if ($request->is_top == null)
            $subcategory->is_top = 0;
        else
            $subcategory->is_top = $request->is_top;

        $subcategory->slug = Str::slug('cat-' . $request->name, '-');

        $subcategory->save();

        return fractal()
        ->item($subcategory)
        ->transformWith(new SubCategoryTransformer)
        ->toArray();
    }

    public function update(UpdateSubCategoryRequest $request, SubCategory $subcategory)
    {
        $subcategory->name = $request->get('name', $subcategory->name);
        $subcategory->is_main = $request->get('is_main', $subcategory->is_main);
        $subcategory->is_top = $request->get('name', $subcategory->is_top);

        $subcategory->save();

        return fractal()
        ->item($subcategory)
        ->transformWith(new SubCategoryTransformer)
        ->toArray();
    }

    public function delete(SubCategory $subcategory)
    {
        //$this->authorize('destroy', $SubCategory);
        $subcategory->delete();

        $returnData = array(
            'status' => 'Deleted',
            'message' => $subcategory->name . ' has been deleted'
            );

        return response()->json($returnData, 404);
    }
}
