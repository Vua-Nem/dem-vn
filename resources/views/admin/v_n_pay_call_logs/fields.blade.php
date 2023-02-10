<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Transaction Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    {!! Form::number('transaction_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_code', 'Bank Code:') !!}
    {!! Form::text('bank_code', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('data', 'Data:') !!}
    {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('vNPayCallLogs.index') }}" class="btn btn-default">Cancel</a>
</div>
