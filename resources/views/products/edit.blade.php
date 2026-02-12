@extends('layout.master')
@section('title', 'Edit Product')
@section('content')
<div class="container mt-5">
    <h1>Edit Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <!-- SKU -->
        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" id="category" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- SubCategory -->
        <div class="mb-3">
            <label>Sub Category</label>
            <select name="sub_category_id" class="form-control" id="sub_category" required>
                <option value="">Select Sub Category</option>
                @foreach($subCategories as $sub)
                    <option value="{{ $sub->id }}"
                        {{ $sub->id == old('sub_category_id', $product->sub_category_id) ? 'selected' : '' }}>
                        {{ $sub->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Cost, Price, Quantity -->
        <div class="mb-3">
            <label>Cost</label>
            <input type="number" name="cost" class="form-control" value="{{ old('cost', $product->cost) }}" required>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($product->image)
                <img src="{{ asset('images/'.$product->image) }}" width="50" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#category').change(function() {
        var categoryId = $(this).val();
        if(categoryId) {
            $.ajax({
                url: '/get-subcategories/' + categoryId,
                type: 'GET',
                success: function(data) {
                    $('#sub_category').empty();
                    $('#sub_category').append('<option value="">Select Sub Category</option>');
                    $.each(data, function(key, value) {
                        $('#sub_category').append('<option val_
