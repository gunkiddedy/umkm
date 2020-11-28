<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getCategory()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getSubCategory(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json($subcategories);
    }

    public function getSubCategories()
    {
        $subcategories = SubCategory::all();
        return response()->json($subcategories);
    }
}

