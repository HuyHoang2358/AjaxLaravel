<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private function getAllCategories(){
        return Category::where('parent_id','=',0)->with('childs')->get();
    }

    public function index(): Factory|View|Application
    {
        return view("admin.content.category",["categories" => $this->getAllCategories()]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $category = Category::create([
            "name" => $input["name"],
            "slug" => $input["slug"] ?? Str::slug($input["name"]),
            "icon" => $input["icon"] ?? "",
            "parent_id" => $input["parent_id"]
        ]);

        return response()->json(['categories' => $this->getAllCategories()]);


    }

}
