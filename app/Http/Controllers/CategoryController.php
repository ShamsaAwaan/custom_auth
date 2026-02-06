<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'is_active' => 'required|in:0,1',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category = Category::create($validated);

        if ($category) {
            return $this->getLatestCategory(true, 'Category created successfully');
        }

        return $this->getLatestCategory(false, 'Category creation failed');
    }

    // ========================
    // EDIT (FETCH DATA)
    // ========================
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'is_active' => 'required|in:0,1',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return $this->getLatestCategory(false, 'Category not found');
        }

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return $this->getLatestCategory(true, 'Category updated successfully');
    }

    // ========================
    // DELETE
    // ========================
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->getLatestCategory(false, 'Category not found');
        }

        $category->delete();

        return $this->getLatestCategory(true, 'Category deleted successfully');
    }

    // ========================
    // REFRESH TABLE
    // ========================
    private function getLatestCategory(
        $success = true,
        $message = 'Success!',
        $html = null
    ) {
        $categories = Category::all();

        if ($html === null) {
            $html = view('category.data-table', compact('categories'))->render();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'html'    => $html
        ]);
    }
}
