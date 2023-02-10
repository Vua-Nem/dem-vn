<!-- Parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{{ $menu->parent_id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $menu->name }}</p>
</div>

<!-- Position Field -->
<div class="form-group">
    {!! Form::label('position', 'Position:') !!}
    <p>{{ $menu->position }}</p>
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', 'Url:') !!}
    <p>{{ $menu->url }}</p>
</div>

<!-- Class Name Field -->
<div class="form-group">
    {!! Form::label('class_name', 'Class Name:') !!}
    <p>{{ $menu->class_name }}</p>
</div>

<!-- Id Name Field -->
<div class="form-group">
    {!! Form::label('id_name', 'Id Name:') !!}
    <p>{{ $menu->id_name }}</p>
</div>

