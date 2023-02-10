<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $promotion->title }}</p>
</div>

<!-- Promotion Type Field -->
<div class="form-group">
    {!! Form::label('promotion_type', 'Promotion Type:') !!}
    <p>{{ $promotion->promotion_type }}</p>
</div>

<!-- Discount Type Field -->
<div class="form-group">
    {!! Form::label('discount_type', 'Discount Type:') !!}
    <p>{{ $promotion->discount_type }}</p>
</div>

<!-- Discount Value Field -->
<div class="form-group">
    {!! Form::label('discount_value', 'Discount Value:') !!}
    <p>{{ $promotion->discount_value }}</p>
</div>

<!-- Min Order Amount Field -->
<div class="form-group">
    {!! Form::label('min_order_amount', 'Min Order Amount:') !!}
    <p>{{ $promotion->min_order_amount }}</p>
</div>

<!-- Min Quantity Item Field -->
<div class="form-group">
    {!! Form::label('min_quantity_item', 'Min Quantity Item:') !!}
    <p>{{ $promotion->min_quantity_item }}</p>
</div>

<!-- Start Date Field -->
<div class="form-group">
    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $promotion->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $promotion->end_date }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $promotion->status }}</p>
</div>

