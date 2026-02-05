<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
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
            'name' => 'required|string|max:255',
            'is_active' => 'required|in:0,1',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $category = Category::create($validated);
        if ($category) {
            return $this->getLatestCategory(true, 'Category created successfully');
        } else {
            return $this->getLatestCategory(false, 'Category creation failed');
        }
    }

    private function getLatestCategory($success = true, $message = 'Category Saved successfully !', $html = null)
    {
            $categories = Category::all();
            if ($html == null) {
                $html = view('category.data-table', compact('categories'))->render();
            }
            return response()->json(['success' => $success, 'message' => $message, 'html' => $html]);
    }
}
