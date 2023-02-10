<div class="table-responsive">
    <table class="table" id="retailerAddresses-table">
        <thead>
            <tr>
                <th>Store Id</th>
        <th>Address</th>
        <th>Tên cửa hàng</th>
        <th>Phone Store</th>
        <th>Province Id</th>
        <th>District Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($retailerAddresses as $retailerAddress)
            <tr>
                <td>{{ $retailerAddress->id }}</td>
            <td>{{ $retailerAddress->address }}</td>
            <td>{{ $retailerAddress->name }}</td>
            <td>{{ $retailerAddress->phone_store }}</td>
            <td>{{ $provinces[$retailerAddress->province_id] ?? '' }}</td>
            <td>{{ $districts[$retailerAddress->district_id] ?? '' }}</td>
                <td>
                    {!! Form::open(['route' => ['retailerAddresses.destroy', $retailerAddress->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('retailerAddresses.show', [$retailerAddress->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('retailerAddresses.edit', [$retailerAddress->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
