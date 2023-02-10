<div class="table-responsive">
    <table class="table" id="wishLists-table">
        <thead>
            <tr>
                <th>Phone Number</th>
        <th>Email</th>
        <th>Full Name</th>
        <th>Province Id</th>
        <th>District Id</th>
        <th>Address</th>
        <th>Oder Item</th>
        <th>Status Telegram</th>
        <th>Time Send Telegram</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($wishLists as $wishList)
            <tr>
                <td>{{ $wishList->phone_number }}</td>
            <td>{{ $wishList->email }}</td>
            <td>{{ $wishList->full_name }}</td>
            <td>{{ $wishList->province_id }}</td>
            <td>{{ $wishList->district_id }}</td>
            <td>{{ $wishList->address }}</td>
            <td>{{ $wishList->oder_item }}</td>
            <td>{{ $wishList->status_telegram }}</td>
            <td>{{ $wishList->time_send_telegram }}</td>
                <td>
                    {!! Form::open(['route' => ['wishLists.destroy', $wishList->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('wishLists.show', [$wishList->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('wishLists.edit', [$wishList->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
