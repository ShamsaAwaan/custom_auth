@extends('layout.master')
@section('title', 'Create SubCategory')

@section('content')
<div class="container mt-5">
    <h1>Create SubCategory</h1>

    @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('sub_category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>SubCategory Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('sub_category.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
