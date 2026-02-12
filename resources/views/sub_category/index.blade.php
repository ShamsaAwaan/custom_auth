@extends('layout.master')
@section('title', 'SubCategories List')

@section('content')
<div class="container mt-5">
    <h1>SubCategories</h1>
    <a href="{{ route('sub_category.create') }}" class="btn btn-primary mb-3">Add SubCategory</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Slug</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subCategories as $sub)
            <tr>
                <td>{{ $sub->id }}</td>
                <td>{{ $sub->name }}</td>
                <td>{{ $sub->category->name }}</td>
                <td>{{ $sub->slug }}</td>
                <td>{{ $sub->is_active ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('sub_category.edit', $sub->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('sub_category.destroy', $sub->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
