<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::number('product_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('type', 0) !!}
        {!! Form::checkbox('type', '1', null) !!}
    </label>
</div>


<!-- Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group_id', 'Group Id:') !!}
    {!! Form::number('group_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('position', 'Position:') !!}
    {!! Form::number('position', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('topProducts.index') }}" class="btn btn-default">Cancel</a>
</div>
