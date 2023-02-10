<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Tiêu đề:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 250]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('code', 'Mã Voucher:') !!}
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 250]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('voucher_type', 'Loại Voucher:') !!}
    <select name="voucher_type" class="form-control">
        <option value="1">Áp dụng cho đơn hàng</option>
        {{--<option value="2">Áp dụng cho sản phẩm</option>--}}
    </select>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('discount_type', 'Lọa giảm giá:') !!}
    <select name="discount_type" class="form-control">
        <option value="{{\App\Models\Voucher::VOUCHER_DISCOUNT_TYPE_IS_FIXED_AMOUNT}}">Giảm theo giá trị</option>
        {{--<option value="{{\App\Models\Voucher::VOUCHER_DISCOUNT_TYPE_IS_PERCENTAGE}}">Giảm theo phần trăm</option>--}}
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('discount_value', 'Giá trị giảm:') !!}
    {!! Form::number('discount_value', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('min_order_amount', 'Giá trị đơn hàng tối thiểu:') !!}
    {!! Form::number('min_order_amount', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-md-6">
    <label for="from_date">Ngày bắt đầu: </label>
    <input name="start_date" type="text" class="form-control datetimepicker" value="@if(isset($voucher->start_date)) {{date("Y/m/d H:i:s", $voucher->start_date)}}@endif">
</div>
<div class="form-group col-md-6 ">
    <label for="to_date">Ngày kết thúc: </label>
    <input name="end_date" type="text" class="form-control datetimepicker" value="@if(isset($voucher->end_date)) {{date("Y/m/d H:i:s", $voucher->end_date)}}@endif">
</div>


<div class="form-group col-sm-6">
    {!! Form::label('status', 'Trạng thái:') !!}
    <select name="status" class="form-control">
        <option value="1">Hoạt động</option>
        <option value="2">Không hoạt động</option>
        <option value="3">Ẩn voucher</option>
    </select>
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('vouchers.index') }}" class="btn btn-default">Cancel</a>
</div>
