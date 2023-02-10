<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}

    @if(isset($product_id))
        {!! Form::number('product_id',$product_id, ['class' => 'form-control' ,'readonly']) !!}
    @else
        {!! Form::number('product_id', null, ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Notify Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notify_title', 'Notify Title:') !!}
    {!! Form::text('notify_title', Request::input('notify_title'), ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Notify Des Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notify_des', 'Notify Des:') !!}
    {!! Form::textarea('notify_des', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
    </label>
    <select name="status" class="form-control">
        @foreach(\App\Models\NotifySale::$status as $key => $status)
            <option @if(isset($notifySale) && $notifySale->status == $key) selected
                    @endif value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('notifySales.index') }}" class="btn btn-default">Cancel</a>
</div>
