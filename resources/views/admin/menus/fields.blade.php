<div class="form-group col-sm-6">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <select name="parent_id" class="form-control">
        <option value="0">Default</option>
        @foreach($menus as $val)
            <option @if(isset($menu->parent_id) && $menu->parent_id == $val->id) selected
                    @endif value="{{$val->id}}">{{$val->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('position', 'Position:') !!}
    {!! Form::number('position', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('class_name', 'Class Name:') !!}
    {!! Form::text('class_name', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('id_name', 'Id Name:') !!}
    {!! Form::text('id_name', null, ['class' => 'form-control','maxlength' => 150,'maxlength' => 150]) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('menus.index') }}" class="btn btn-default">Cancel</a>
</div>
