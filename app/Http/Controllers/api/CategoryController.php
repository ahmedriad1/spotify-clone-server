<?php

namespace App\Http\Controllers\api;

use App\Category as Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminCategory;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('show');
    }

    public function index()
    {
        return AdminCategory::collection(Category::latest()->paginate());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')]
        ]);

        $data = ['name' => $request->name];

        if ($request->description) $data['description'] = $request->description;
        Category::create($data);
        return response()->json([
            'status' => 200,
            'message' => 'Category created !'
        ]);
    }

    public function edit(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')->ignore($category->id)]
        ]);

        $data = ['name' => $request->name];
        if ($request->description) $data['description'] = $request->description;

        $category->update($data);
        return response()->json([
            'status' => 200,
            'message' => 'Category updated !'
        ]);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Category deleted !'
        ]);
    }
} // Category Controller
