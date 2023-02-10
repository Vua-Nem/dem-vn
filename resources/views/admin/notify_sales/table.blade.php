<div class="table-responsive">
    <table class="table" id="notifySales-table">
        <thead>
            <tr>
                <th>Product Id</th>
        <th>Notify Title</th>
        <th>Notify Des</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notifySales as $notifySale)
            <tr>
                <td>{{ $notifySale->product_id }}</td>
            <td>{{ $notifySale->notify_title }}</td>
            <td>{{ $notifySale->notify_des }}</td>
            <td  >
                @if($notifySale->status == 1)
                    <label class="label btn-success"> Enable</label>
                @else
                    <label class="label btn-danger"> Dislable</label>

                @endif
            </td>
                <td>
                    {!! Form::open(['route' => ['notifySales.destroy', $notifySale->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('notifySales.show', [$notifySale->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('notifySales.edit', [$notifySale->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
