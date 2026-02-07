@foreach($products as $key=>$product)

<tr>
<td>{{ $key+1 }}</td>
<td>{{ $product->name }}</td>
<td>{{ $product->price }}</td>

<td>
<span class="badge bg-{{ $product->is_active ? 'success':'danger' }}">
{{ $product->is_active ? 'Active':'Inactive' }}
</span>
</td>

<td>

<button class="btn btn-sm btn-warning editProduct"
data-id="{{ $product->id }}">
Edit
</button>

<button class="btn btn-sm btn-danger deleteProduct"
data-id="{{ $product->id }}">
Delete
</button>

</td>
</tr>

@endforeach
