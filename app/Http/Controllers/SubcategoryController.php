<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Category;

class SubcategoryController extends Controller
{
    public function index(Category $category){
        $subcategories = Subcategory::where('category_id', $category->id)->get();

        return view('subcategories', compact('subcategories'));
    }
}
