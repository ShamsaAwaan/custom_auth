@extends('layout.master')
@section('content')
<div class="card">
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
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#category-table').DataTable();
    });
</script>
@endsection
