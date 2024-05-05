<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::all();

        return response()->json($categories);
    }

    public function show(Category $category){
        return response()->json($category);
    }

    public function service(Category $category){
        $services = $category->services()->get();

        return response()->json($services);

    }
}
