@extends('layout.master')
@section('title', 'Create Product')
@section('content')
<div class="container mt-5">
    <h1>Create Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- SKU -->
        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" id="category" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- SubCategory -->
        <div class="mb-3">
            <label>Sub Category</label>
            <select name="sub_category_id" class="form-control" id="sub_category" required>
                <option value="">Select Sub Category</option>
            </select>
        </div>

        <!-- Cost, Price, Quantity -->
        <div class="mb-3">
            <label>Cost</label>
            <input type="number" name="cost" class="form-control" value="{{ old('cost') }}" required>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    $('#category').on('change', function(){
        var categoryId = $(this).val();

        if(categoryId){
            $.ajax({
                url: "{{ url('/get-subcategories') }}/" + categoryId,
                type: "GET",
                dataType: "json",
                success: function(data){

                    $('#sub_category').empty();
                    $('#sub_category').append('<option value="">Select Sub Category</option>');

                    $.each(data, function(key, value){
                        $('#sub_category').append(
                            '<option value="'+ value.id +'">'+ value.name +'</option>'
                        );
                    });
                }
            });
        } else {
            $('#sub_category').empty();
        }
    });

});
</script>

@endsection
