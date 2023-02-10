<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Sản phẩm:') !!}
    <select name="product_id" class="form-control">
        @foreach($products as $product)
            <option @if(isset($productImage) && $productImage->product_id == $product->id) selected
                @endif value="{{$product->id}}">{{$product->name}}</option>
        @endforeach
    </select>
</div>

<!-- Product Variant Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_variant_id', 'Thuộc tính:') !!}
    <select class="form-control" id="attribute_1" name="attribute">
        <option value="0">No Select</option>
        @foreach($attributes as $value)
            <option value="{{$value->id}}">{{$value->name}}</option>
        @endforeach
    </select>
</div>

<!-- Attribute Value Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attribute_value_id', 'Giá trị thuộc tính:') !!}
    <select class="form-control" id="attribute_1_value" name="attribute_value_id">
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Lưu', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('productAttributeValues.index') }}" class="btn btn-default">Hủy</a>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            $("#attribute_1").on("change", function (e) {
                $.ajax({
                    url: '{{route("ajaxGetAttributeValue")}}?attribute_id=' + $(this).val(),
                }).done(function (data) {
                    $("#attribute_1_value").html(data)
                });
            })

            $("#attribute_2").on("change", function (e) {
                $.ajax({
                    url: '{{route("ajaxGetAttributeValue")}}?attribute_id=' + $(this).val(),
                }).done(function (data) {
                    $("#attribute_2_value").html(data)
                });
            })
        });
    </script>
@endpush