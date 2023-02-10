@extends('layouts.mobile_checkout')
@section('content')
<div class="section-main">
  {{ Widget::run('mobile.checkoutCart') }}
  <div class="block-payment">
    <div class="step step-active">
      <div class="step-header">
        <div class="step-number">1</div>
        <label>THÔNG TIN KHÁCH HÀNG</label>
      </div>
      <form class="form-customer" method="post" action="{{route("order.customer")}}">
        {{csrf_field()}}
        <div class="form-row">
          <div class="form-group">
            <div class="label">
              <div>
                Họ Tên&nbsp;<span class="required-star">*</span>
              </div>
              @if ($errors->has('full_name'))
                <span class="error-message">{{ $errors->first('full_name') }}</span>
              @endif
            </div>
            <input type="text" class="form-control form-custom @if($errors->has('full_name')) error @endif" name="full_name" id="full_name"  value="@if(isset($customer["full_name"])) {{$customer["full_name"]}}@endif">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <div class="label">
              <div>
                Số điện thoại&nbsp;<span class="required-star">*</span>
              </div>
              @if($errors->has('phone'))
                <span class="error-message">{{ $errors->first('phone') }}</span>
              @endif
            </div>
            <input type="text" class="form-control form-custom @if($errors->has('phone')) error @endif" name="phone" id="phone" value="@if(isset($customer["phone"])){{$customer["phone"]}}@endif">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <div class="label">
              <div>
                Địa chỉ giao hàng&nbsp;<span class="required-star">*</span>
              </div>
              @if ($errors->has('address'))
                <span class="error-message">{{ $errors->first('address') }}</span>
              @endif
            </div>
            <textarea class="form-control form-custom input-area input-address @if($errors->has('address')) error @endif" name="address" id="address">@if(isset($customer["address"])) {{$customer["address"]}}@endif</textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <div class="label">Ghi chú</div>
            <textarea class="form-control form-custom input-area input-note" name="note">@if(isset($customer["note"])) {{$customer["note"]}}@endif</textarea>
          </div>
        </div>
        <button class="button-action js-ga-click-address" type="submit">
          <span>Tiếp Tục</span>
          <img class="lazyload" data-src="{{url('mobile/newImage/home/right-arrow.svg')}}" alt="" />
        </button>
      </form>
    </div>
    <div class="step">
      <div class="step-header">
        <div class="step-number">2</div>
        <div class="block-detail">
          <label>PHƯƠNG THỨC THANH TOÁN</label>
          <span class="step-des">Toàn bộ các giao dịch được bảo mật và mã hoá</span>
        </div>
      </div>
    </div>
    <div class="step">
      <div class="step-header">
        <div class="step-number">3</div>
        <div class="block-detail">
          <label>HOÀN TẤT ĐƠN HÀNG</label>
          <span class="step-des">Cảm ơn quý khách hàng đã tin tưởng Vuanem</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
