@extends('layout.master')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">Category List</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal" id="addCategoryButton">
            <i class="icon-base ti tabler-plus"></i>
            Create Category
          </button>
    </div>

    <div class="card-datatable table-responsive pt-0">
      <table class="datatables-basic table" id="category-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="category-table-body">
           @include('category.data-table')
        </tbody>
      </table>
    </div>
  </div>
  <!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" id="editCategoryId">

        <div class="mb-4">
          <label class="form-label">Category Name</label>
          <input type="text" id="editCategoryName" class="form-control">
        </div>

        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="editCategoryStatus">
          <label class="form-check-label">Active</label>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="updateCategoryBtn">Update</button>
      </div>

    </div>
  </div>
</div>







      <!-- Modal -->
      <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategoryModalTitle">Add Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
                <label for="categoryName" class="form-label" required>Category Name</label>
                <input type="text" id="categoryName" class="form-control" placeholder="Enter category name" />
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="categoryStatus" checked required />
                <label class="form-check-label" for="categoryStatus">Active</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="saveCategoryButton">Save</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#category-table').DataTable();
        $('#saveCategoryButton').click(function(event) {
            event.preventDefault();
            var categoryName = $('#categoryName').val();
            var categoryStatus = $('#categoryStatus').is(':checked') ? 1 : 0;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('category.store') }}',
                type: 'POST',
                data: {
                    name: categoryName,
                    is_active: categoryStatus,
                    _token: csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        $('#addCategoryModal').modal('hide');
                        // toastr.success(response.message);
                        $('#categoryName').val('');
                        $('#categoryStatus').prop('checked', true);
                        $('#category-table-body').html('');
                        $('#category-table-body').html(response.html);
                    } else {
                        // toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
    //delete
    $(document).on('click', '.deleteBtn', function () {

    if(!confirm('Are you sure you want to delete this category?')) return;

    let id = $(this).data('id');
    let token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: `/category/delete/${id}`,
        type: 'DELETE',
        data: {
            _token: token
        },
        success: function (response) {

            if(response.success){
                $('#category-table-body').html(response.html);
            }else{
                alert(response.message);
            }

        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});
//ediit-update
$(document).on('click', '.editBtn', function () {

    let id = $(this).data('id');

    $.ajax({
        url: `/category/edit/${id}`,
        type: 'GET',

        success: function (res) {

            if(res.success){

                $('#editCategoryId').val(res.data.id);
                $('#editCategoryName').val(res.data.name);
                $('#editCategoryStatus').prop('checked', res.data.is_active == 1);

                $('#editCategoryModal').modal('show');
            }
        }
    });
});
$(document).on('click', '#updateCategoryBtn', function (e) {

    e.preventDefault();

    let id = $('#editCategoryId').val();
    let token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: `/category/update/${id}`,
        type: 'POST',
        data: {
            name: $('#editCategoryName').val(),
            is_active: $('#editCategoryStatus').is(':checked') ? 1 : 0,
            _token: token
        },

        success: function (response) {

            if(response.success){

                $('#editCategoryModal').modal('hide');

                $('#category-table-body').html(response.html);
            } else {
                alert(response.message);
            }
        },

        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


</script>
@endsection
