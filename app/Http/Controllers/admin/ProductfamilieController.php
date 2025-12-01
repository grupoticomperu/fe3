<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductfamilieController extends Controller
{

    public function create()
    {
    	$categories = Category::all();
        $brands = Brand::all();
    	return view('admin.productfamilie.create',compact('categories','brands'));
    }
}
