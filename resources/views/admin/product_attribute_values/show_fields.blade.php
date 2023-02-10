<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Sản phẩm:') !!}
    <p>{{ $productAttributeValue->product->name }}</p>
</div>

<!-- Product Variant Id Field -->
<div class="form-group">
    {!! Form::label('product_variant_id', 'Biến thể sản phẩm:') !!}
    <p>{{ $productAttributeValue->productVariant->name }}</p>
</div>

<!-- Attribute Value Id Field -->
<div class="form-group">
    {!! Form::label('attribute_value_id', 'Thuộc tính:') !!}
    <p>{{ $productAttributeValue->attributeValue->attribute->name }}</p>
</div>

<!-- Attribute Value Id Field -->
<div class="form-group">
    {!! Form::label('attribute_value_id', 'Giá trị thuộc tính sản phẩm:') !!}
    <p>{{ $productAttributeValue->attributeValue->value }}</p>
</div>

