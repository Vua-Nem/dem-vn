<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $notifySale->product_id }}</p>
</div>

<!-- Notify Title Field -->
<div class="form-group">
    {!! Form::label('notify_title', 'Notify Title:') !!}
    <p>{{ $notifySale->notify_title }}</p>
</div>

<!-- Notify Des Field -->
<div class="form-group">
    {!! Form::label('notify_des', 'Notify Des:') !!}
    <p>{{ $notifySale->notify_des }}</p>
</div>

