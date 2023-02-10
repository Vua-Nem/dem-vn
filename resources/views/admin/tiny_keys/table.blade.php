<div class="table-responsive">
    <table class="table" id="tinyKeys-table">
        <thead>
            <tr>
                <th>Count Seccsion</th>
        <th>Api Key</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tinyKeys as $tinyKey)
            <tr>
                <td>{{ $tinyKey->count_seccsion }}</td>
            <td>{{ $tinyKey->api_key }}</td>
            <td>{{ $tinyKey->status }}</td>
                <td>
                    {!! Form::open(['route' => ['tinyKeys.destroy', $tinyKey->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tinyKeys.show', [$tinyKey->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('tinyKeys.edit', [$tinyKey->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
