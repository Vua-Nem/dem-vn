<!-- Order No Field -->
<div class="form-group">
    {!! Form::label('order_no', 'Order No:') !!}
    <p>{{ $payooCallLog->order_id }}</p>
</div>

<!-- Data Field -->
<div class="form-group">
    {!! Form::label('data', 'Data:') !!}
    <p>{{ $payooCallLog->data }}</p>
</div>

