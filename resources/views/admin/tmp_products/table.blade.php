<div class="table">
    <table class="table" id="tmpProducts-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Parent Id</th>
            <th>Product Id</th>
            <th>Sku</th>
            <th width="300px">Content</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tmpProducts as $tmpProduct)
            <tr>
                <td>{{ $tmpProduct->id }}</td>
                <td>{{ $tmpProduct->product_parent }}</td>
                <td>{{ $tmpProduct->product_id }}</td>
                <td>{{ $tmpProduct->sku }}</td>
                <td width="300px">{{ $tmpProduct->content }}</td>
                <td>
                    {!! Form::open(['route' => ['tmpProducts.destroy', $tmpProduct->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tmpProducts.show', [$tmpProduct->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('tmpProducts.edit', [$tmpProduct->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $tmpProducts->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
