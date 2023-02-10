<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{{ $vNPayCallLogs->order_id }}</p>
</div>

<!-- Transaction Id Field -->
<div class="form-group">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{{ $vNPayCallLogs->transaction_id }}</p>
</div>

<!-- Bank Code Field -->
<div class="form-group">
    {!! Form::label('bank_code', 'Bank Code:') !!}
    <p>{{ $vNPayCallLogs->bank_code }}</p>
</div>

<!-- Data Field -->
<div class="form-group">
    {!! Form::label('data', 'Data:') !!}
    <p>{{ $vNPayCallLogs->data }}</p>
</div>

