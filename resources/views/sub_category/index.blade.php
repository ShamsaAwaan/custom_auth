@extends('layout.master')
@section('title', 'SubCategories List')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>SubCategories List</h3>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubCategoryModal">
    Add SubCategory
</button>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search + Per Page --}}
    <div class="d-flex justify-content-between mb-2">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search SubCategories...">
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

    {{-- SubCategories Table --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subCategories as $subCategory)
                <tr>
                    <td>{{ $loop->iteration + ($subCategories->currentPage()-1) * $subCategories->perPage() }}</td>
                    <td>{{ $subCategory->name }}</td>
                    <td>{{ $subCategory->slug }}</td>
                    <td>{{ $subCategory->category->name ?? 'N/A' }}</td>
                    <td>{{ $subCategory->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('sub_category.edit', $subCategory->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sub_category.destroy', $subCategory->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure to delete?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No subcategories found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($subCategories->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item {{ $subCategories->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $subCategories->previousPageUrl() }}">&laquo;</a>
            </li>

            @foreach ($subCategories->getUrlRange(1, $subCategories->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $subCategories->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <li class="page-item {{ $subCategories->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $subCategories->nextPageUrl() }}">&raquo;</a>
            </li>
        </ul>
    </nav>
    @endif
</div>
@endsection
<div class="modal fade" id="addSubCategoryModal" tabindex="-1" aria-labelledby="addSubCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('sub_category.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSubCategoryModalLabel">Add SubCategory</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" required>
          </div>
          <div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>

          <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="subIsActive">
            <label class="form-check-label" for="subIsActive">Active</label>
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
