<!-- Attribute Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attribute_id', 'Thuộc tính:') !!}
    <select name="attribute_id" class="form-control">
        @foreach($attributes as $value)
            <option value="{{$value->id}}">{{$value->name}}</option>
        @endforeach
    </select>
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Giá trị:') !!}
    {!! Form::text('value', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Lưu', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('attributeValues.index') }}" class="btn btn-default">Hủy</a>
</div>
