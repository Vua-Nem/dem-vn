<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<div class="clearfix"></div>

<div class="form-group col-sm-6">
    {!! Form::label('promotion_type', 'Loại khuyến mại:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('promotion_type', 0) !!}
    </label>
    <select name="promotion_type" class="form-control">
        @foreach(\App\Models\Promotion::$promotionType as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('promotion_objects', 'ID Đối Tượng Áp dụng:') !!}
    <input type="text" class="form-control" name="promotion_objects"
           value="@if(isset($strObjects)){{$strObjects}}@endif"
           placeholder="Id ngăn cách bằng dấy phẩy(,) ví dụ: 1001,1002,11003">
</div>
<div class="clearfix"></div>
<br>
<br>
<div class="clearfix"></div>

<div class="form-group col-sm-6">
    {!! Form::label('discount_type', 'Loại giảm giá:') !!}
    <select name="discount_type" class="form-control">
        @foreach(\App\Models\Promotion::$discountType as $key => $value)
            <option @if(isset($promotion->discount_type) && $promotion->discount_type == $key) selected
                    @endif value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('discount_value', 'Giá trị giảm:') !!}
    {!! Form::number('discount_value', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>
<br>
<br>

<div class="clearfix"></div>
<div class="form-group col-sm-6">
    {!! Form::label('min_order_amount', 'Giá trị đơn hàng tối thiểu:') !!}
    {!! Form::number('min_order_amount', null, ['class' => 'form-control', "placeholder" => "Điền giá trị 0 để bỏ qua"]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('min_quantity_item', 'Số lượng item tối thiểu:') !!}
    {!! Form::number('min_quantity_item', null, ['class' => 'form-control', "placeholder" => "Điền giá trị 0 để bỏ qua"]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Ngày bắt đầu:') !!}
    <input name="start_date"
           value="@if(isset($promotion->start_date)){{date("Y/m/d H:i:s", $promotion->start_date)}}@endif"
           class="form-control" placeholder="2021/01/01 00:00:00">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('end_date', 'Ngày kết thúc:') !!}
    <input name="end_date" value="@if(isset($promotion->end_date)){{date("Y/m/d H:i:s", $promotion->end_date)}}@endif"
           class="form-control" placeholder="2021/01/10 23:59:00">
</div>
<div class="clearfix"></div>
<br>
<br>
<div class="clearfix"></div>
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <select name="status" class="form-control">
        @foreach(\App\Models\Promotion::$promotionStatus as $key => $value)
            <option @if(isset($promotion->status) && $promotion->status == $key) selected
                    @endif value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('promotions.index') }}" class="btn btn-default">Cancel</a>
</div>


@push('css')

@endpush

@push('scripts')

@endpush


