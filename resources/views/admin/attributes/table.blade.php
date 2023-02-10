<div class="table-responsive">
    <table class="table" id="attributes-table">
        <thead>
            <tr>
                <th>Attribute Code</th>
        <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($attributes as $attribute)
            <tr>
                <td>{{ $attribute->attribute_code }}</td>
            <td>{{ $attribute->name }}</td>
                <td>
                    {!! Form::open(['route' => ['attributes.destroy', $attribute->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('attributes.show', [$attribute->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('attributes.edit', [$attribute->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
