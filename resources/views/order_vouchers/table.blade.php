<div class="table-responsive">
    <table class="table" id="orderVouchers-table">
        <thead>
            <tr>
                <th>Order Id</th>
        <th>Voucher Id</th>
        <th>Voucher Discount Type</th>
        <th>Voucher Discount Value</th>
        <th>Voucher Created By</th>
        <th>Voucher Start Date</th>
        <th>Voucher End Date</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orderVouchers as $orderVoucher)
            <tr>
                <td>{{ $orderVoucher->order_id }}</td>
            <td>{{ $orderVoucher->voucher_id }}</td>
            <td>{{ $orderVoucher->voucher_discount_type }}</td>
            <td>{{ $orderVoucher->voucher_discount_value }}</td>
            <td>{{ $orderVoucher->voucher_created_by }}</td>
            <td>{{ $orderVoucher->voucher_start_date }}</td>
            <td>{{ $orderVoucher->voucher_end_date }}</td>
                <td>
                    {!! Form::open(['route' => ['orderVouchers.destroy', $orderVoucher->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('orderVouchers.show', [$orderVoucher->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('orderVouchers.edit', [$orderVoucher->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
