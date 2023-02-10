<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $productVariant->product_id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $productVariant->name }}</p>
</div>

<!-- Slug Field -->
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $productVariant->slug }}</p>
</div>

<!-- Sku Field -->
<div class="form-group">
    {!! Form::label('sku', 'Sku:') !!}
    <p>{{ $productVariant->sku }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $productVariant->price }}</p>
</div>

<!-- Compare Price Field -->
<div class="form-group">
    {!! Form::label('compare_price', 'Compare Price:') !!}
    <p>{{ $productVariant->compare_price }}</p>
</div>

<!-- Qty Field -->
<div class="form-group">
    {!! Form::label('qty', 'Qty:') !!}
    <p>{{ $productVariant->qty }}</p>
</div>

