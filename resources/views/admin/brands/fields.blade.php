<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    <input type="file" name="brand_img" value="">
</div>
@if(isset($brand->image) && !empty($brand->image))
<img width="150px"
     src="{{route("showImage", ["entity" => "brands","id" => $brand->id, "fileName" => $brand->image])}}">
@endif
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('brands.index') }}" class="btn btn-default">Cancel</a>
</div>
