<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    // ========================
    // List Sub Categories
    // ========================
    public function index(Category $category)
    {
        $subCategories = $category->subCategories;

        return view('sub-category.index', compact('category', 'subCategories'));
    }

    // ========================
    // Store
    // ========================
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'is_active'   => 'required|in:0,1',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'is_active'   => $request->is_active,
        ]);

        return $this->latest(true, 'Sub Category Created');
    }

    // ========================
    // Edit
    // ========================
    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data'    => SubCategory::findOrFail($id),
        ]);
    }

    // ========================
    // Update
    // ========================
    public function update(Request $request, $id)
    {
        $sub = SubCategory::findOrFail($id);

        $sub->update([
            'name'      => $request->name,
            'slug'      => Str::slug($request->name),
            'is_active' => $request->is_active,
        ]);

        return $this->latest(true, 'Updated Successfully');
    }

    // ========================
    // Delete
    // ========================
    public function destroy($id)
    {
        SubCategory::findOrFail($id)->delete();

        return $this->latest(true, 'Deleted');
    }

    // ========================
    // Ajax Refresh Table
    // ========================
    private function latest($success, $message)
    {
        $subCategories = SubCategory::where(
            'category_id',
            request('category_id')
        )->get();

        $html = view('sub-category.data-table', compact('subCategories'))->render();

        return response()->json(compact('success', 'message', 'html'));
    }

    // ========================
    // Fetch By Category (Dropdown)
    // ========================
    public function byCategory($id)
    {
        $subs = SubCategory::where('category_id', $id)->get();

        return response()->json([
            'html' => view('partials.sub-options', compact('subs'))->render(),
        ]);
    }
}
