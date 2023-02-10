<div class="table-responsive">
    <table class="table" id="vouchers-table">
        <thead>
        <tr>
            <th>Code</th>
            <th>Title</th>
            <th>Voucher Type</th>
            <th>Discount Type</th>
            <th>Discount Value</th>
            <th>Min Order Amount</th>
            <th>Min Quantity Item</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th style="color:black">Created By</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->code }}</td>
                <td>{{ $voucher->title }}</td>
                <td>{{ $voucher->voucher_type }}</td>
                <td>{{ $voucher->discount_type }}</td>
                <td>{{ $voucher->discount_value }}</td>
                <td>{{ $voucher->min_order_amount }}</td>
                <td>{{ $voucher->min_quantity_item }}</td>
                <td>{{date("Y/m/d H:i:s", $voucher->start_date)}}</td>
                <td>{{date("Y/m/d H:i:s", $voucher->end_date)}}</td>
                {{--<td style="{{ $voucher->start_date<=time() && $voucher->end_date> time() ? "font-size: 15px;" : '' }}" class="{{ $voucher->start_date <= time() && $voucher->end_date > time() ? "btn btn-success" : "btn btn-danger" }}">--}}
                    {{--{{$voucher->start_date <= time() && $voucher->end_date > time() ? "Enable" : "Disable" }}--}}
                {{--</td>--}}
                <td style="{{ $voucher->start_date<=time() && $voucher->end_date> time() ? "font-size: 15px;" : '' }}" >
                    @if($voucher->status == 1)
                        <label class="label btn-success"> Enable</label>
                    @elseif($voucher->status == 2)
                        <label class="label btn-danger"> Dislable</label>
                    @else
                        <label class="label btn-warning"> Ẩn voucher</label>
                    @endif
                </td>
                <td>{{ $voucher->created_by }}</td>
                <td>
                    {!! Form::open(['route' => ['vouchers.destroy', $voucher->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('vouchers.show', [$voucher->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('vouchers.edit', [$voucher->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
