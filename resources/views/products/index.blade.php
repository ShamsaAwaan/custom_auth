@extends('layout.master')
@section('title', 'Products List')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Products List</h3>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
    Add Product
</button>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search + Per Page --}}
    <div class="d-flex justify-content-between mb-2">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search Products...">
            <button class="btn btn-secondary" type="submit">Search</button>
        </form>

        <form method="GET" class="d-flex align-items-center gap-2">
            <label>Show</label>
            <select name="per_page" onchange="this.form.submit()" class="form-select w-auto">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
            </select>
        </form>
    </div>

    {{-- Products Table --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Cost</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach($products as $product)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->sku }}</td>
    <td>{{ $product->category->name ?? 'N/A' }}</td>
    <td>{{ $product->subCategory->name ?? 'N/A' }}</td>
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

        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete('delete-form-{{ $product->id }}')" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach


        </tbody>
    </table>

    {{-- Pagination --}}
    @if($products->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous --}}
            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $products->previousPageUrl() }}">&laquo;</a>
            </li>

            {{-- Numbers --}}
            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Next --}}
            <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $products->nextPageUrl() }}">&raquo;</a>
            </li>
        </ul>
    </nav>
    @endif
</div>
@endsection

{{-- Optional: Rounded modern pagination CSS --}}
@push('styles')
<style>
.pagination .page-item .page-link {
    border-radius: 50% !important;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
}
.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}
</style>
@endpush
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label>Sub Category</label>
            <select name="sub_category_id" class="form-control" required>
                @foreach($subCategories as $subCategory)
                  <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label>Cost</label>
            <input type="number" name="cost" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="productIsActive">
            <label class="form-check-label" for="productIsActive">Active</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>
