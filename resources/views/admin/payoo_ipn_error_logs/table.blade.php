<div class="table-responsive">
    <table class="table" id="payooIpnErrorLogs-table">
        <thead>
            <tr>
                <th>Order Id</th>
        <th>Error</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payooIpnErrorLogs as $payooIpnErrorLog)
            <tr>
                <td>{{ $payooIpnErrorLog->order_id }}</td>
            <td>{{ $payooIpnErrorLog->error }}</td>
                <td>
                    {!! Form::open(['route' => ['payooIpnErrorLogs.destroy', $payooIpnErrorLog->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('payooIpnErrorLogs.show', [$payooIpnErrorLog->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('payooIpnErrorLogs.edit', [$payooIpnErrorLog->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
