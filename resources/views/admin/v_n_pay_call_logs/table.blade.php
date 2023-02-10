<div class="table-responsive">
    <table class="table" id="vNPayCallLogs-table">
        <thead>
            <tr>
                <th>Order Id</th>
        <th>Transaction Id</th>
        <th>Bank Code</th>
        <th>Data</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($vNPayCallLogs as $vNPayCallLogs)
            <tr>
                <td>{{ $vNPayCallLogs->order_id }}</td>
            <td>{{ $vNPayCallLogs->transaction_id }}</td>
            <td>{{ $vNPayCallLogs->bank_code }}</td>
            <td>{{ $vNPayCallLogs->data }}</td>
                <td>
                    {!! Form::open(['route' => ['vNPayCallLogs.destroy', $vNPayCallLogs->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('vNPayCallLogs.show', [$vNPayCallLogs->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('vNPayCallLogs.edit', [$vNPayCallLogs->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
