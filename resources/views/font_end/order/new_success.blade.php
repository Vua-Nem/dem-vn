<?php
  use App\Models\Orders;
?>
@extends('layouts.master_checkout')
@section('content')
<div class="section-main">
  <div class="block-payment">
    <div class="step step-active">
      <div class="step-number"><img class="lazyload" data-src="{{url('web/newImage/payment/confirm.svg')}}" alt=""></div>
      <div class="block-detail">
        <div class="d-flex justify-content-between">
          <label>THÔNG TIN KHÁCH HÀNG</label>
        </div>
        <div class="customer-info">
          <span>{{$order->user_name}}</span>
          <span>{{$order->address}}</span>
          <span>{{phone($order->phone)}}</span>
          <span>{{$order->note}}</span>
        </div>
      </div>
    </div>
    <div class="step step-active">
      <div class="step-number"><img class="lazyload" data-src="{{url('web/newImage/payment/confirm.svg')}}" alt=""></div>
      <div class="block-detail">
        <label>PHƯƠNG THỨC THANH TOÁN</label>
        <span class="step-des">Toàn bộ các giao dịch được bảo mật và mã hoá</span>
        <div class="payment-method">Phương thức thanh toán:&nbsp;<span>{{Orders::$paymentMethod[$order->payment_method]}}</span></div>
      </div>
    </div>
    <div class="step step-active">
      <div class="step-number"><img class="lazyload" data-src="{{url('web/newImage/payment/confirm.svg')}}" alt=""></div>
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
  <div class="block-order">
    <div class="order-title">Chi Tiết Đơn Hàng</div>
    <div class="block-detail">
      <div class="list-product">
        @foreach($order->items as $item)
        <div class="product">
          <div class="product-image">
            <img src="{{$item->productImages->first()->name}}" alt="" width="114px" height="93px">
          </div>
          <div class="product-info">
            <div class="product-name">{{$item->productVariant->name}}</div>
            <p class="product-variant">
              Kích thước: {{$item->productVariant->width}} x {{$item->productVariant->length}}cm
              <br>
              Độ dày: {{$item->productVariant->thickness}}cm
              <br>
              Số lượng: {{$item->quantity}}
            </p>
          </div>
          <div class="block-price">
            <p class="price">{{price($item->productVariant->price)}} đ</p>
            <p class="compare-price">{{price($item->productVariant->compare_price)}} đ</p>
          </div>
        </div>
        @endforeach
      </div>
      <div id="block-total">
        <div class="block-order-price">
          <div class="order-price">
            <span class="title">Thành tiền</span>
            <span class="value">{{price($order->amount)}} đ</span>
          </div>
          <div class="voucher-code">
            <span class="title">Mã giảm giá</span>
            <div class="d-flex align-items-center gap-2">
              @if ($order->orderVoucher)
                <div class="value">-{{price($order->orderVoucher->voucher_discount_value)}} đ</div>
              @else
                <div class="value">0 đ</div>
              @endif
            </div>
          </div>
        </div>
        <div class="total">
          <div class="total-price">
            <span class="title">Tổng</span>
            <span class="value">{{price($order->real_amount)}} đ</span>
          </div>
          <span class="note">(Đã bao gồm VAT)</span>
        </div>
      </div>
    </div>
    <div class="policies">
      <div class="item">
        <img class="lazyload" data-src="{{url('web/newImage/detail/policy_1.svg')}}" alt="" />
        <p>180 ngày&nbsp;<span>ngủ thử</span></p>
      </div>
      <div class="item">
        <img class="lazyload" data-src="{{url('web/newImage/detail/policy_2.svg')}}" alt="" />
        <p>Vận chuyển&nbsp;<span>Miễn Phí</span></p>
      </div>
      <div class="item">
        <img class="lazyload" data-src="{{url('web/newImage/detail/policy_3.svg')}}" alt="" />
        <p>Bảo hành&nbsp;<span>Chính Hãng</span></p>
      </div>
    </div>
  </div>
</div>
@endsection

