<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $voucher->title }}</p>
</div>

<!-- Voucher Type Field -->
<div class="form-group">
    {!! Form::label('voucher_type', 'Voucher Type:') !!}
    <p>{{ $voucher->voucher_type }}</p>
</div>

<!-- Discount Type Field -->
<div class="form-group">
    {!! Form::label('discount_type', 'Discount Type:') !!}
    <p>{{ $voucher->discount_type }}</p>
</div>

<!-- Discount Value Field -->
<div class="form-group">
    {!! Form::label('discount_value', 'Discount Value:') !!}
    <p>{{ $voucher->discount_value }}</p>
</div>

<!-- Min Order Amount Field -->
<div class="form-group">
    {!! Form::label('min_order_amount', 'Min Order Amount:') !!}
    <p>{{ $voucher->min_order_amount }}</p>
</div>

<!-- Min Quantity Item Field -->
<div class="form-group">
    {!! Form::label('min_quantity_item', 'Min Quantity Item:') !!}
    <p>{{ $voucher->min_quantity_item }}</p>
</div>

<!-- Start Date Field -->
<div class="form-group">

    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $voucher->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $voucher->end_date }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $voucher->status }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $voucher->created_by }}</p>
</div>

