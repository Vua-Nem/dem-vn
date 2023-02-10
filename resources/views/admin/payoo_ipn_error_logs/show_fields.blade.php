<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{{ $payooIpnErrorLog->order_id }}</p>
</div>

<!-- Error Field -->
<div class="form-group">
    {!! Form::label('error', 'Error:') !!}
    <p>{{ $payooIpnErrorLog->error }}</p>
</div>

