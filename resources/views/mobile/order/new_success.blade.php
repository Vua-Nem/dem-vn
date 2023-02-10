<?php
  use App\Models\Orders;
?>
@extends('layouts.mobile_checkout')
@section('content')
<div class="section-main">
  {{ Widget::run('mobile.checkoutCart') }}
  <div class="block-payment">
    <div class="step step-active">
      <div class="step-header">
        <div class="step-number"><img class="lazyload" data-src="{{url('mobile/newImage/payment/confirm.svg')}}" alt=""></div>
        <div class="flex-grow-1">
          <label>THÔNG TIN KHÁCH HÀNG</label>
          <div class="customer-info">
            <span>{{$order->user_name}}</span>
            <span>{{$order->address}}</span>
            <span>{{phone($order->phone_number)}}</span>
            <span>{{$order->note}}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="step step-active">
      <div class="step-header">
        <div class="step-number"><img class="lazyload" data-src="{{url('mobile/newImage/payment/confirm.svg')}}" alt=""></div>
        <div class="block-detail">
          <label>PHƯƠNG THỨC THANH TOÁN</label>
          <span class="step-des">Toàn bộ các giao dịch được bảo mật và mã hoá</span>
          <div class="payment-method">Phương thức thanh toán:&nbsp;<span>{{Orders::$paymentMethod[$order->payment_method]}}</span></div>
        </div>
      </div>
    </div>
    <div class="step step-active">
      <div class="step-header">
        <div class="step-number"><img class="lazyload" data-src="{{url('mobile/newImage/payment/confirm.svg')}}" alt=""></div>
        <div class="block-detail">
          <label>HOÀN TẤT ĐƠN HÀNG</label>
          <span class="step-des">Cảm ơn quý khách hàng đã tin tưởng Vuanem</span>
        </div>
      </div>

      <div class="block-complete">
        <img class="lazyload" data-src="{{url('web/newImage/payment/complete.png')}}" alt="">
        <p>Cảm ơn bạn đã tin tưởng lựa chọn Dem.vn</p>
        <span>Mã đơn hàng: {{$order->id}}<br>Nhân viên Dem.vn sẽ chủ động liên hệ với bạn trong thời gian sớm nhất</span>
        <a href="{{route('home')}}">Về trang chủ</a>
      </div>
    </div>
  </div>
</div>
@endsection
