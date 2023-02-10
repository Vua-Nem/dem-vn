<div class="table-responsive">
    <table class="table" id="productBundles-table">
        <thead>
            <tr>
                <th>Product Id</th>
        <th>Product Attach SKU</th>
        <th>Product Attach Price</th>
        <th>Quantity Number</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($productBundles as $productBundles)
            <tr>
                <td>{{ $productBundles->product_id }}</td>
            <td>{{ $productBundles->product_attach_id }}</td>
            <td>{{ $productBundles->product_attach_price }}</td>
            <td>{{ $productBundles->quantity_number }}</td>
                <td>
                    {!! Form::open(['route' => ['productBundles.destroy', $productBundles->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('productBundles.show', [$productBundles->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('productBundles.edit', [$productBundles->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
