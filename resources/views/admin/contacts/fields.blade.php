<div class="form-group col-sm-6">
  {!! Form::label('name', 'Tên:') !!}
  {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('phone', 'Điện thoại:') !!}
  {!! Form::text('phone', null, ['class' => 'form-control','maxlength' => 50]) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::submit('Lưu', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('contacts.index') }}" class="btn btn-default">Hủy bỏ</a>
</div>
