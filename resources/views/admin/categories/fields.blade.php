<div class="form-group col-sm-12">
  {!! Form::label('name', 'Tên:') !!}
  {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('description', 'Mô tả:') !!}
  <textarea class="form-control" id="description" name="description" cols="12" rows="5">
    @if(isset($category->description)){{$category->description}}@endif
  </textarea>
</div>

<div class="form-group col-sm-12">
  {!! Form::submit('Lưu', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('categories.index') }}" class="btn btn-default">Hủy bỏ</a>
</div>
