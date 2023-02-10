<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Voucher Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('voucher_id', 'Voucher Id:') !!}
    {!! Form::number('voucher_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Voucher Discount Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('voucher_discount_type', 'Voucher Discount Type:') !!}
    {!! Form::number('voucher_discount_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Voucher Discount Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('voucher_discount_value', 'Voucher Discount Value:') !!}
    {!! Form::number('voucher_discount_value', null, ['class' => 'form-control']) !!}
</div>

<!-- Voucher Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('voucher_created_by', 'Voucher Created By:') !!}
    {!! Form::number('voucher_created_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Voucher Start Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('voucher_start_date', 'Voucher Start Date:') !!}
    {!! Form::number('voucher_start_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Voucher End Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('voucher_end_date', 'Voucher End Date:') !!}
    {!! Form::number('voucher_end_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('orderVouchers.index') }}" class="btn btn-default">Cancel</a>
</div>
