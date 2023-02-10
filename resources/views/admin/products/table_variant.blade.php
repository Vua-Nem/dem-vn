<div class="table">
    <table class="table" id="products-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Sku</th>
            <th>Name</th>
            <th>Inventory</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($product->variants as $variant)
            <tr>
                <td>{{ $variant->id }}</td>
                <td>{{ $variant->sku }}</td>
                <td>{{ $variant->name }}</td>
                <td>{{ $variant->qty }}</td>
                <td>{{ \App\Models\ProductVariant::$status[$variant->status] }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('productVariants.edit', [$variant->id]) }}?product_id={{$product->id}}" class='btn btn-default btn-xs'>
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
