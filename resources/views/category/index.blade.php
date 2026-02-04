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
    {{-- @dd('hello am here') --}}
    <div class="card-datatable table-responsive pt-0">
      <table class="datatables-basic table" id="category-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 100; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td>Category {{ $i }}</td>
                <td>category-{{ $i }}-slug</td>
                <td>2026-01-{{ $i }}</td>
                <td>2026-01-{{ $i }}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="icon-base ti tabler-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-pencil me-1"></i> Edit</a>
                          <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                </td>
            </tr>
            @endfor
        </tbody>
      </table>
    </div>
  </div>






      <!-- Modal -->
      <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategoryModalTitle">Add Category</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row g-4">
                <div class="col mb-4">
                  <label for="categoryName" class="form-label">Category Name</label>
                  <input
                    type="text"
                    id="categoryName"
                    class="form-control"
                    placeholder="Enter Name" />
                </div>
              </div>
              <div class="row g-4">
                <div class="col mb-0">
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="categoryStatus" checked />
                        <label class="form-check-label" for="categoryStatus"
                          >Active</label
                        >
                      </div>
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#category-table').DataTable();
    });
</script>
@endsection
