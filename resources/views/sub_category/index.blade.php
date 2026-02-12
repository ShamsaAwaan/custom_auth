@extends('layout.master')
@section('title', 'SubCategories List')
@section('content')

<div class="container mt-5">
    <h3 class="mb-3">SubCategories List</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search + Per Page + Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex gap-2">
            <!-- Search -->
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search subcategories..." class="form-control">
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

        <!-- Add SubCategory Button (Top Right) -->
        <a href="{{ route('sub_category.create') }}" class="btn btn-success btn-sm">Add SubCategory</a>
    </div>

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subCategories as $subCategory)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subCategory->name }}</td>
                    <td>{{ $subCategory->category->name }}</td>
                    <td>{{ $subCategory->slug }}</td>
                    <td>{{ $subCategory->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('sub_category.edit', $subCategory->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('sub_category.destroy', $subCategory->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this subcategory?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No subcategories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div>{{ $subCategories->links() }}</div>
</div>

@endsection
