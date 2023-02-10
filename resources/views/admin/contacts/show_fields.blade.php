<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Tên:') !!}
    <p>{{ $contact->full_name }}</p>
</div>
<div class="form-group">
    {!! Form::label('phone', 'Điện thoại:') !!}
    <p>{{ $contact->phone }}</p>
</div>

