<div class="table-responsive">
    <table class="table" id="orderlogs-table">
        <thead>
            <tr>
                <th>Order Id</th>
        <th>Content</th>
        <th>Created By</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orderlogs as $orderlog)
            <tr>
                <td>{{ $orderlog->order_id }}</td>
            <td>{{ $orderlog->content }}</td>
            <td>{{ $orderlog->created_by }}</td>
                <td>
                    {!! Form::open(['route' => ['orderlogs.destroy', $orderlog->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('orderlogs.show', [$orderlog->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('orderlogs.edit', [$orderlog->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
