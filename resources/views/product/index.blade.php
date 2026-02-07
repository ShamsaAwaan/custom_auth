@extends('layout.master')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Products — {{ $subCategory->name }}</h5>

        <button class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#addProductModal">
            Add Product
        </button>
    </div>

    <div class="table-responsive">
        <table class="table" id="product-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="product-table-body">
                @include('product.data-table')
            </tbody>
        </table>
    </div>
</div>

<!-- ADD PRODUCT MODAL -->
<div class="modal fade" id="addProductModal">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5>Add Product</h5>
</div>

<div class="modal-body">

<input type="hidden" id="sub_category_id"
 value="{{ $subCategory->id }}">

<div class="mb-3">
<label>Name</label>
<input type="text" id="productName" class="form-control">
</div>

<div class="mb-3">
<label>Price</label>
<input type="number" id="productPrice" class="form-control">
</div>
<div class="mb-3">
    <label>Category</label>
    <select id="category_id" class="form-control">
        <option value="">-- Select Category --</option>

        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Sub Category</label>
    <select id="sub_category_id" name="sub_category_id" class="form-control">
        <option value="">-- Select Sub Category --</option>
    </select>
</div>

<div class="mb-3">
<label>Status</label>
<select id="productStatus" class="form-control">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

</div>

<div class="modal-footer">
<button class="btn btn-primary" id="saveProductBtn">Save</button>
</div>

</div>
</div>
</div>
  <!-- #region
<!-- EDIT PRODUCT MODAL -->
<div class="modal fade" id="editProductModal">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5>Edit Product</h5>
</div>

<div class="modal-body">

<input type="hidden" id="editProductId">

<div class="mb-3">
<label>Name</label>
<input type="text" id="editProductName" class="form-control">
</div>

<div class="mb-3">
<label>Price</label>
<input type="number" id="editProductPrice" class="form-control">
</div>

<div class="mb-3">
<label>Status</label>
<select id="editProductStatus" class="form-control">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

<div class="mb-3">
<label>Image</label>
<input type="file" id="editProductImage" class="form-control">
</div>

</div>

<div class="modal-footer">
<button class="btn btn-primary" id="updateProductBtn">
Update
</button>
</div>

</div>
</div>
</div>
-->
@endsection

@section('scripts')

<script>
$(function(){

$('#saveProductBtn').click(function(){

let data = {
    sub_category_id: $('#sub_category_id').val(),
    name: $('#productName').val(),
    price: $('#productPrice').val(),
    is_active: $('#productStatus').val(),
    _token: "{{ csrf_token() }}"
};

$.post("{{ route('product.store') }}",data,function(res){

    if(res.success){
        $('#product-table-body').html(res.html);
        $('#addProductModal').modal('hide');
    }

});

});

});

// OPEN EDIT
$(document).on('click','.editProduct',function(){

let id = $(this).data('id');

$.get('/product/edit/'+id,function(res){

    if(res.success){

        $('#editProductId').val(res.data.id);
        $('#editProductName').val(res.data.name);
        $('#editProductPrice').val(res.data.price);
        $('#editProductStatus').val(res.data.is_active);

        $('#editProductModal').modal('show');
    }

});

});


// UPDATE
$('#updateProductBtn').click(function(){

let id = $('#editProductId').val();

let formData = new FormData();

formData.append('name',$('#editProductName').val());
formData.append('price',$('#editProductPrice').val());
formData.append('is_active',$('#editProductStatus').val());
formData.append('_token',"{{ csrf_token() }}");

if($('#editProductImage')[0].files[0]){
    formData.append('image',$('#editProductImage')[0].files[0]);
}

$.ajax({
    url:'/product/update/'+id,
    type:'POST',
    data:formData,
    processData:false,
    contentType:false,

    success:function(res){

        if(res.success){

            $('#product-table-body').html(res.html);
            $('#editProductModal').modal('hide');

        }

    }
});

});
$(document).on('click','.deleteProduct',function(){

let id = $(this).data('id');

if(!confirm('Delete product?')) return;

$.ajax({
    url:'/product/delete/'+id,
    type:'DELETE',
    data:{
        _token:"{{ csrf_token() }}"
    },

    success:function(res){

        if(res.success){
            $('#product-table-body').html(res.html);
        }

    }
});

});
$('#category_id').change(function(){

    let id = $(this).val();

    if(id == ''){
        $('#sub_category_id').html('<option value="">-- Select Sub Category --</option>');
        return;
    }

    $.get('/get-subcategories/'+id,function(res){

        $('#sub_category_id').html(res.html);

    });

});


</script>

@endsection
