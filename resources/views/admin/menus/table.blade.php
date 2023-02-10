<div class="table-responsive">
    <table class="table" id="menus-table">
        <thead>
        <tr>
            <th>Parent ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Url</th>
            <th>Class Name</th>
            <th>Id Name</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->parent_id }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->position }}</td>
                <td>{{ $menu->url }}</td>
                <td>{{ $menu->class_name }}</td>
                <td>{{ $menu->id_name }}</td>
                <td>
                    {!! Form::open(['route' => ['menus.destroy', $menu->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('menus.show', [$menu->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('menus.edit', [$menu->id]) }}" class='btn btn-default btn-xs'><i
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
