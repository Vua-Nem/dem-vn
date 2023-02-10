<div class="table-responsive">
    <table class="table" id="seoContens-table">
        <thead>
            <tr>
                <th>Entity Id</th>
        <th>Entity Type</th>
        <th>Meta Title</th>
        <th>Meta Keyword</th>
        <th>Meta Des</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($seoContens as $seoContent)
            <tr>
                <td>{{ $seoContent->entity_id }}</td>
            <td>{{ \App\Models\SeoContent::$arry_seo_type[$seoContent->entity_type] }}</td>
            <td>{{ $seoContent->meta_title }}</td>
            <td>{{ $seoContent->meta_keyword }}</td>
            <td>{{ $seoContent->meta_des }}</td>
                <td>
                    {!! Form::open(['route' => ['seoContents.destroy', $seoContent->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('seoContents.show', [$seoContent->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('seoContents.edit', [$seoContent->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $seoContens->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
    </div>

</div>
