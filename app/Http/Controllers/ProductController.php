<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
public function index(Request $request)
{
    $query = Product::with(['category', 'subCategory']);

    // Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('sku', 'like', '%' . $request->search . '%');
        });
    }

    // Filter by category
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    // Filter by subcategory
    if ($request->sub_category_id) {
        $query->where('sub_category_id', $request->sub_category_id);
    }

    // ✅ Pagination with dynamic per page
    $perPage = $request->per_page ?? 10;
    $products = $query->paginate($perPage)->withQueryString();

    $categories = Category::where('is_active', 1)->get();
    $subCategories = SubCategory::where('is_active', 1)->get();

    return view('products.index', compact('products', 'categories', 'subCategories'));
}



    public function create()
    {
        $categories = Category::where('is_active',1)->get();
        $subCategories = SubCategory::where('is_active',1)->get();
        return view('products.create', compact('categories', 'subCategories'));
    }
public function getSubCategories($categoryId)
{
    $subCategories = SubCategory::where('category_id', $categoryId)
                    ->where('is_active', 1)
                    ->get();

    return response()->json($subCategories);
}

   public function store(Request $request)
{
    $request->validate([
    'name' => 'required',
    'sku' => 'required|unique:products,sku',
    'category_id' => 'required|exists:categories,id',
    'sub_category_id' => 'required|exists:sub_categories,id',
    'cost' => 'required|numeric',
    'price' => 'required|numeric',
    'quantity' => 'required|integer',
    'image' => 'nullable|image|max:2048',
]);


    $data = $request->all();
    $data['is_active'] = $request->has('is_active') ? 1 : 0;

    Product::create($data);

    return redirect()->route('products.index')
        ->with('success', 'Product created successfully!');
}


    public function edit(Product $product)
    {
        $categories = Category::where('is_active',1)->get();
        $subCategories = SubCategory::where('is_active',1)->get();
        return view('products.edit', compact('product', 'categories', 'subCategories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku,'.$product->id,
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

}
