<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $tmpProduct->product_id }}</p>
</div>

<!-- Sku Field -->
<div class="form-group">
    {!! Form::label('sku', 'Sku:') !!}
    <p>{{ $tmpProduct->sku }}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $tmpProduct->content }}</p>
</div>

