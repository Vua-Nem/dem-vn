<!-- Title Field -->

<div class="form-group col-sm-6">
    {!! Form::label('entity_id', 'Entity Id:') !!}

    @if(isset($entity_id))
        {!! Form::number('entity_id',$entity_id, ['class' => 'form-control' ,'readonly']) !!}
    @else
        {!! Form::number('entity_id', null, ['class' => 'form-control']) !!}
    @endif
</div>

<div class="form-group col-sm-6 pull-left">
    {!! Form::label('entity_type', 'Entity Type:') !!}
    <select name="entity_type" class="form-control">
        @foreach(\App\Models\CountDown::$arry_count_down_type as $key => $val)
            <option @if(request()->get('entity_type') == $key) selected @endif value="{{$key}}">{{$val}}</option>
        @endforeach
    </select>

</div>

<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', Request::input('name'), ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<div class="form-group col-md-6">
    <label for="start_date">Ngày bắt đầu: </label>
    <input name="start_date" type="text" class="form-control datetimepicker" value="@if(isset($countDown->start_date)) {{ date('Y-m-d H:i',strtotime($countDown->start_date)) }}@endif">
</div>
<div class="form-group col-md-6 pull-right">
    <label for="end_date">Ngày kết thúc: </label>
    <input name="end_date" type="text" class="form-control datetimepicker" value="@if(isset($countDown->end_date)) {{ date('Y-m-d H:i',strtotime($countDown->end_date)) }}@endif">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
    </label>
    <select name="status" class="form-control">
        @foreach(\App\Models\CountDown::$status as $key => $status)
            <option @if(isset($countDown) && $countDown->status == $key) selected
                    @endif value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('start_hour', 'Start Hours:') !!}
    {!! Form::text('start_hour', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('countDowns.index') }}" class="btn btn-default">Cancel</a>
</div>


