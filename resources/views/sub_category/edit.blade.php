@extends('layout.master')
@section('title', 'Edit SubCategory')
@section('content')

<div class="container mt-5">
    <h4>Edit SubCategory</h4>

    <form action="{{ route('sub_category.update', $subCategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == $subCategory->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $subCategory->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" value="{{ $subCategory->slug }}" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input"
                {{ $subCategory->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('sub_category.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
