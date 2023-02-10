<div class="table-responsive">
    <table class="table" id="promotionObjects-table">
        <thead>
        <tr>
            <th>Promotion Id</th>
            <th>Object Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($promotionObjects as $promotionObject)
            <tr>
                <td>{{ $promotionObject->promotion_id }}</td>
                <td>{{ $promotionObject->object_id }}</td>
                <td>
                    {!! Form::open(['route' => ['promotionObjects.destroy', $promotionObject->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('promotionObjects.edit', [$promotionObject->id]) }}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
