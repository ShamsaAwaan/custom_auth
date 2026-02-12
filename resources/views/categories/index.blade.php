@extends('layout.master')
@section('title', 'Categories List')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Categories List</h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add Category
    </button>
</div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search + Per Page --}}
    <div class="d-flex justify-content-between mb-2">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search Categories...">
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

    {{-- Categories Table --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $category->name }}</td>
    <td>{{ $category->slug }}</td>
    <td>{{ $category->is_active ? 'Yes' : 'No' }}</td>
    <td>
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>

        <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete('delete-form-{{ $category->id }}')" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach

        </tbody>
    </table>

    {{-- Pagination --}}
    @if($categories->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $categories->previousPageUrl() }}">&laquo;</a>
            </li>

            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $categories->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <li class="page-item {{ $categories->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $categories->nextPageUrl() }}">&raquo;</a>
            </li>
        </ul>
    </nav>
    @endif
</div>
@endsection
<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('categories.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
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
          <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="isActive">
            <label class="form-check-label" for="isActive">Active</label>
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
