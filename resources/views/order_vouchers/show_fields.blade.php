<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{{ $orderVoucher->order_id }}</p>
</div>

<!-- Voucher Id Field -->
<div class="form-group">
    {!! Form::label('voucher_id', 'Voucher Id:') !!}
    <p>{{ $orderVoucher->voucher_id }}</p>
</div>

<!-- Voucher Discount Type Field -->
<div class="form-group">
    {!! Form::label('voucher_discount_type', 'Voucher Discount Type:') !!}
    <p>{{ $orderVoucher->voucher_discount_type }}</p>
</div>

<!-- Voucher Discount Value Field -->
<div class="form-group">
    {!! Form::label('voucher_discount_value', 'Voucher Discount Value:') !!}
    <p>{{ $orderVoucher->voucher_discount_value }}</p>
</div>

<!-- Voucher Created By Field -->
<div class="form-group">
    {!! Form::label('voucher_created_by', 'Voucher Created By:') !!}
    <p>{{ $orderVoucher->voucher_created_by }}</p>
</div>

<!-- Voucher Start Date Field -->
<div class="form-group">
    {!! Form::label('voucher_start_date', 'Voucher Start Date:') !!}
    <p>{{ $orderVoucher->voucher_start_date }}</p>
</div>

<!-- Voucher End Date Field -->
<div class="form-group">
    {!! Form::label('voucher_end_date', 'Voucher End Date:') !!}
    <p>{{ $orderVoucher->voucher_end_date }}</p>
</div>

