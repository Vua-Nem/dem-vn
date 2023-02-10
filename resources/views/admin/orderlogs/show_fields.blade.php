<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{{ $orderlog->order_id }}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $orderlog->content }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $orderlog->created_by }}</p>
</div>

