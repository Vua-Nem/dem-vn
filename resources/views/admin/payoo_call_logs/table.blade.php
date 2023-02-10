<div class="table-responsive">
    <table class="table" id="payooCallLogs-table">
        <thead>
            <tr>
                <th>Order No</th>
        <th>Data</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payooCallLogs as $payooCallLog)
            <tr>
                <td>{{ $payooCallLog->order_id }}</td>
            <td>{{ $payooCallLog->data }}</td>
                <td>
                    {!! Form::open(['route' => ['payooCallLogs.destroy', $payooCallLog->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('payooCallLogs.show', [$payooCallLog->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
