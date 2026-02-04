@if(!empty($categories))
@foreach ($categories as $key => $category)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $category->name ? $category->name : '-' }}</td>
    <td>{{ $category->slug ? $category->slug : '-' }}</td>
    <td>
    <div class="demo-inline-spacing">
        <span class="badge text-bg-{{ $category->is_active ? 'success' : 'danger' }}">{{ $category->is_active ? 'Active' : 'Inactive' }}</span>
    </div>
    </td>
    <td>{{ $category->created_at ? $category->created_at->format('Y-m-d H:i:s') : '-' }}</td>
    <td>{{ $category->updated_at ? $category->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
            <i class="icon-base ti tabler-dots-vertical"></i>
            </button>
            <div class="dropdown-menu">
            <a class="dropdown-item waves-effect" href="{{ route('category.edit', $category->id) }}"><i class="icon-base ti tabler-pencil me-1"></i> Edit</a>
            <a class="dropdown-item waves-effect" href="{{ route('category.delete', $category->id) }}"><i class="icon-base ti tabler-trash me-1"></i> Delete</a>
            </div>
        </div>
    </td>
</tr>
@endforeach
@endif