<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Sản phẩm:') !!}
    <p>{{ $productImage->product->name }}</p>
</div>

<!-- Path Field -->
<div class="form-group">
    {!! Form::label('path', 'Đường dẫn:') !!}
    <p>{{ $productImage->path }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Loại:') !!}
    <p>{{ \App\Models\ProductImage::$imageType[$productImage->type] }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Tên:') !!}
    <p>{{ $productImage->name }}</p>
</div>

