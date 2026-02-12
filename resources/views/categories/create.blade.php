@extends('layout.master')
@section('title', 'Create Category')

@section('content')
<div class="container mt-5">
    <h1>Create Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>
       <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
        {{ old('is_active', $category->is_active ?? 1) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Active</label>
</div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
