<div class="table-responsive">
    <table class="table" id="countDowns-table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Title</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($countDowns as $countDown)

            <tr>
            <td>{{ $countDown->id }}</td>
            <td>{{ $countDown->title }}</td>
            <td>{{ $countDown->name }}</td>
            <td>{{  $countDown->start_date }}</td>
            <td>{{$countDown->end_date }}</td>
            <td  >
                @if($countDown->status == 1)
                    <label class="label btn-success"> Enable</label>
                @else
                    <label class="label btn-danger"> Dislable</label>

                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['countDowns.destroy', $countDown->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{{ route('countDowns.show', [$countDown->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{ route('countDowns.edit', [$countDown->id,'entity_type' => $countDown->entity_type]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
