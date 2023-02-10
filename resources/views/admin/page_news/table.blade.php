<div class="table-responsive">
    <table class="table" id="pageNews-table">
        <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Comment</th>
            <th>Slost</th>
            <th>Status</th>
            <th>Type</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pageNews as $pageNew)
            <tr>
                <td>
                    <img width="150px"
                         src="{{route("showImage", [
                         'entity' => 'page_news',
                         "fileName" => empty($pageNew->name) ? "default.jpg" : $pageNew->name,
                         "size" => 255,
                         "id" => $pageNew->id
                         ])}}">
                </td>
                <td>{{ $pageNew->title }}</td>
                <td>{{ $pageNew->comment }}</td>
                <td>{{ $pageNew->slost }}</td>
                <td>@if($pageNew->status == 0) No @endif @if($pageNew->status == 1) Yes @endif</td>
                <td>@if($pageNew->type == 0) Image  @endif  @if($pageNew->type == 1) Video @endif</td>
                <td>
                    {!! Form::open(['route' => ['pageNews.destroy', $pageNew->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('pageNews.show', [$pageNew->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('pageNews.edit', [$pageNew->id]) }}" class='btn btn-default btn-xs'><i
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
