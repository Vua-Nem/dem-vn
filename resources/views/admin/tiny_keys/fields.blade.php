<div class="form-group col-sm-6">
    {!! Form::label('api_key', 'Api Key:') !!}
    {!! Form::text('api_key', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <select class="form-control" name="status">
        <option value="1">Active</option>
        <option value="-1">Disable</option>
    </select>
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tinyKeys.index') }}" class="btn btn-default">Cancel</a>
</div>
