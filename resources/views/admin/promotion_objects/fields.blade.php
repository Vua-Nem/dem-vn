<!-- Promotion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('promotion_id', 'Promotion Id:') !!}
    {!! Form::number('promotion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Object Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('object_id', 'Object Id:') !!}
    {!! Form::number('object_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('promotionObjects.index') }}" class="btn btn-default">Cancel</a>
</div>
