<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();
        return view('sub_category.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name',
            'slug' => 'required|unique:sub_categories,slug',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        SubCategory::create($data);

        return redirect()->route('sub_category.index')->with('success', 'Sub Category created successfully!');
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('sub_category.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name,'.$subCategory->id,
            'slug' => 'required|unique:sub_categories,slug,'.$subCategory->id,
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $subCategory->update($data);

        return redirect()->route('sub_category.index')->with('success', 'Sub Category updated successfully!');
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('sub_category.index')->with('success', 'Sub Category deleted successfully!');
    }
}
