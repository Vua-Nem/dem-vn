<div class="table-responsive">
    <table class="table" id="productImages-table">
        <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Đường dẫn</th>
            <th>Loại</th>
            <th>Tên</th>
            <th colspan="3">Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productImages as $productImage)
            <tr>
                <td>{{ $productImage->product->name }}</td>
                <td>{{ $productImage->path }}</td>
                <td>{{ \App\Models\ProductImage::$imageType[$productImage->type] }}</td>
                <td>{{ $productImage->name }}</td>
                <td>
                    {!! Form::open(['route' => ['productImages.destroy', $productImage->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('productImages.show', [$productImage->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('productImages.edit', [$productImage->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $productImages->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
