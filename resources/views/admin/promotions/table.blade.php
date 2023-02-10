<div class="table-responsive">
    <table class="table" id="promotions-table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Promotion Type</th>
            <th>Discount Type</th>
            <th>Discount Value</th>
            <th>Min Order Amount</th>
            <th>Min Quantity Item</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($promotions as $promotion)
            <tr>
                <td>{{ $promotion->title }}</td>
                <td>{{ \App\Models\Promotion::$promotionType[$promotion->promotion_type] }}</td>
                <td>{{ \App\Models\Promotion::$discountType[$promotion->discount_type] }}</td>
                <td>{{ number_format($promotion->discount_value, 0, '.', ',') }}</td>
                <td>{{ number_format($promotion->min_order_amount, 0, '.', ',') }}</td>
                <td>{{ $promotion->min_quantity_item }}</td>
                <td>{{ date("Y-m-d H:i:s", $promotion->start_date) }}</td>
                <td>{{ date("Y-m-d H:i:s", $promotion->end_date) }}</td>
                <td>{{ \App\Models\Promotion::$promotionStatus[$promotion->status] }}</td>
                <td>
                    {!! Form::open(['route' => ['promotions.destroy', $promotion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('promotions.edit', [$promotion->id]) }}" class='btn btn-default btn-xs'><i
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
