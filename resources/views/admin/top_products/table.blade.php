<div class="table-responsive">
    <table class="table" id="topProducts-table">
        <thead>
            <tr>
                <th>Product Id</th>
        <th>Type</th>
        <th>Group Id</th>
        <th>Position</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($topProducts as $topProduct)
            <tr>
                <td>{{ $topProduct->product_id }}</td>
            <td>{{ $topProduct->type }}</td>
            <td>{{ $topProduct->group_id }}</td>
            <td>{{ $topProduct->position }}</td>
                <td>
                    {!! Form::open(['route' => ['topProducts.destroy', $topProduct->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('topProducts.show', [$topProduct->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('topProducts.edit', [$topProduct->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
