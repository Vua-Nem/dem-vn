<div class="table-responsive">
  <table class="table" id="productAttributeValues-table">
    <thead>
      <tr>
        <th>Sản phẩm</th>
        <th>Biến thể sản phẩm</th>
        <th>Thuộc tính</th>
        <th>Giá trị thuộc tính</th>
        <th colspan="3">Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productAttributeValues as $productAttributeValue)
      <tr>
        <td>{{ $productAttributeValue->product->name }}</td>
        <td>{{ $productAttributeValue->productVariant->name }}</td>
        <td>{{ $productAttributeValue->attributeValue->attribute->name }}</td>
        <td>{{ $productAttributeValue->attributeValue->value }}</td>
        <td>
          {!! Form::open(['route' => ['productAttributeValues.destroy', $productAttributeValue->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{{ route('productAttributeValues.show', [$productAttributeValue->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{{ route('productAttributeValues.edit', [$productAttributeValue->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div>
    {{ $productAttributeValues->links('vendor.pagination.bootstrap-4') }}
  </div>
</div>

