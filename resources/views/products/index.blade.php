@extends('layout.master')
@section('title', 'Products List')
@section('content')

<div class="container mt-5">
    <h3 class="mb-3">Products List</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search + Per Page + Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex gap-2">
            <!-- Search -->
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="form-control">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
            </form>

            <!-- Per Page Dropdown -->
            <form method="GET" class="d-flex align-items-center gap-2">
                <label>Show</label>
                <select name="per_page" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                </select>
            </form>
        </div>

        <!-- Add Product Button (Top Right) -->
        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">Add Product</a>
    </div>

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Category</th>
                <th>SubCategory</th>
                <th>Cost</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->subCategory->name }}</td>
                    <td>{{ $product->cost }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('images/'.$product->image) }}" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div>{{ $products->links() }}</div>
</div>

@endsection
