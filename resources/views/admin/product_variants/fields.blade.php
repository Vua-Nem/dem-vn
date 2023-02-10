<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Parent:') !!}
    <input name="product_id" value="{{$product->id}}" type="hidden">
    <input value="{{$product->name}}" disabled class="form-control">
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Sku Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sku', 'Sku:') !!}
    {!! Form::text('sku', null, ['class' => 'form-control','maxlength' => 30,'maxlength' => 30]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Compare Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('compare_price', 'Compare Price:') !!}
    {!! Form::number('compare_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qty', 'Qty:') !!}
    {!! Form::number('qty', null, ['class' => 'form-control']) !!}
</div>
<!-- Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('width', 'Width:') !!}
    {!! Form::number('width', null, ['class' => 'form-control']) !!}
</div>

<!-- Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('length', 'Length:') !!}
    {!! Form::number('length', null, ['class' => 'form-control']) !!}
</div>

<!-- Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('thickness', 'Thickness:') !!}
    {!! Form::number('thickness', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
    </label>
    <select name="status" class="form-control">
        @foreach(\App\Models\ProductVariant::$status as $key => $status)
            <option @if(isset($productVariant) && $productVariant->status == $key) selected
                    @endif value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</div>
<div class="clearfix"></div>
<br>
<br>
<br>
@if(isset($productVariant->productAttributeValue))
    @foreach($productVariant->productAttributeValue as $attrValue)
        <div class="form-group col-sm-6">
            <label>{{$attrValue->attributeValue->attribute->name}}:</label>
            <input type="text" class="form-control" disabled value="{{$attrValue->attributeValue->value}}">
        </div>
    @endforeach
@endif
@if(empty($variantAttribute))
    @if(isset($attributes))
        <div>
            <div class="form-group col-sm-6" id="option-1">
                <label>Attribute 1: <span class="index-1"></span></label>
                <select class="form-control" id="attribute_1" name="attribute_id_1">
                    <option value="0">No Select</option>
                    @foreach($attributes as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6" id="option-2">
                <label>Attribute 1 Value: <span class="index-1"></span></label>
                <select class="form-control" id="attribute_1_value" name="attribute_value_id_1">
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
        <div>
            <div class="form-group col-sm-6" id="option-1">
                <label>Attribute 2: <span class="index-1"></span></label>
                <select class="form-control" id="attribute_2" name="attribute_id_2">
                    <option value="0">No Select</option>
                    @foreach($attributes as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6" id="option-2">
                <label>Attribute 2 Value: <span class="index-1"></span></label>
                <select class="form-control" id="attribute_2_value" name="attribute_value_id_2">
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
    @endif
@else
    @if(isset($variantAttribute[0]))
        <div>
            <div class="col-sm-6 form-group">
                <input type="hidden" name="attribute_id_1" value="{{$variantAttribute[0]}}">
                @foreach($attributes as $attribute)
                    @if($attribute->id == $variantAttribute[0])
                        <label>Attribute 1: <span class="index-1"></span></label>
                        <input disabled class="form-control" value="{{$attribute->name}}"/>
                    @endif
                @endforeach
            </div>
            <div class="col-sm-6">
                <label>Attribute 1 Value: <span class="index-1"></span></label>
                <select name="attribute_value_id_1" class="form-control">
                    @foreach($variantAttributeValue as $value)
                        @if($value->attribute_id == $variantAttribute[0])
                            <option value="{{$value->id}}">{{$value->value}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
    @endif
    @if(isset($variantAttribute[1]))
        <div>
            <div class="col-sm-6 form-group">
                <input type="hidden" name="attribute_id_2" value="{{$variantAttribute[1]}}">
                @foreach($attributes as $attribute)
                    @if($attribute->id == $variantAttribute[1])
                        <label>Attribute 2: <span class="index-1"></span></label>
                        <input disabled class="form-control" value="{{$attribute->name}}"/>
                    @endif
                @endforeach
            </div>
            <div class="col-sm-6">
                <label>Attribute 2 Value: <span class="index-1"></span></label>
                <select name="attribute_value_id_2" class="form-control">
                    @foreach($variantAttributeValue as $value)
                        @if($value->attribute_id == $variantAttribute[1])
                            <option value="{{$value->id}}">{{$value->value}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
    @endif
@endif

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('productVariants.index') }}" class="btn btn-default">Cancel</a>
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
