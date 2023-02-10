<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::number('product_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Attach Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_attach_id', 'Product Attach SKU:') !!}
    {!! Form::text('product_attach_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Attach Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_attach_price', 'Product Attach Price:') !!}
    {!! Form::number('product_attach_price', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('quantity_number', 'Quantity Number:') !!}
    {!! Form::number('quantity_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('productBundles.index') }}" class="btn btn-default">Cancel</a>
</div>
