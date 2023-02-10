@extends('layouts.mobile_checkout')
@section('content')
<div class="section-main">
  {{ Widget::run('mobile.checkoutCart') }}
  <div class="block-payment">
    <div class="step step-active">
      <div class="step-header">
        <div class="step-number"><img class="lazyload" data-src="{{url('mobile/newImage/payment/confirm.svg')}}" alt=""></div>
        <div class="flex-grow-1">
          <div class="d-flex justify-content-between">
            <label>THÔNG TIN KHÁCH HÀNG</label>
            <a href="{{route("order.checkOut")}}" class="text-decoration">Sửa</a>
          </div>
          <div class="customer-info">
            <span>{{$customer["full_name"]}}</span>
            <span>{{$customer["address"]}}</span>
            <span>{{phone($customer["phone"])}}</span>
            <span>{{$customer["note"]}}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="step step-active">
      <div class="step-header">
        <div class="step-number">2</div>
        <div class="block-detail">
          <label>PHƯƠNG THỨC THANH TOÁN</label>
          <span class="step-des">Toàn bộ các giao dịch được bảo mật và mã hoá</span>
        </div>
      </div>
      <form method="post" action="{{route("order.saveOrder")}}" class="w-100">
        {{csrf_field()}}
        <div id="payment-form">
          <label class="check-box cod">
            <input type="radio" checked name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_COD}}">
            <span class="check"></span>
            <p>Thanh toán khi nhận hàng</p>
          </label>

          <label class="check-box vnpay">
            <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_VNP}}">
            <span class="check"></span>
            <div class="group-icon">
              <p class="flex-grow-1">Thanh toán bằng thẻ tín dụng</p>
              <div class="d-flex gap-2">
                <img class="lazyload" data-src="{{url('mobile/newImage/payment/visa.svg')}}" alt="">
                <img class="lazyload" data-src="{{url('mobile/newImage/payment/master-card.svg')}}" alt="">
                <img class="lazyload" data-src="{{url('mobile/newImage/payment/jcb.svg')}}" alt="">
              </div>
            </div>
          </label>

          <label class="check-box flex-wrap">
            <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_INTERNET_BANKING}}">
            <span class="check"></span>
            <p>Chuyển khoản ngân hàng</p>
            <div class="tabs-bank">
              <div class="tabs">
                <div class="tablinks active" onclick="openCity(event, 'vcb')">
                  <img class="lazyload" data-src="{{url('mobile/newImage/payment/bank-vietcombank.svg')}}" alt="">
                </div>
                <div class="tablinks" onclick="openCity(event, 'bvd')">
                  <img class="lazyload" data-src="{{url('mobile/newImage/payment/bank-bidv.svg')}}" alt="">
                </div>
              </div>
              <div id="vcb" class="tabcontent">
                <div class="bank-items-1">
                  <h2>Tài khoản Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank)</h2>
                  <div class="d-flex flex-column" style="gap: 9px">
                    <p>
                      <img class="lazyload" data-src="{{url('mobile/newImage/payment/bullet.svg')}}" alt="">
                      Số tài khoản:&nbsp;<strong>0971.0000.15217</strong>
                    </p>
                    <p>
                      <img class="lazyload" data-src="{{url('mobile/newImage/payment/bullet.svg')}}" alt="">
                      Chủ tài khoản:&nbsp;<strong>Công ty cổ phần Vua Nệm</strong>
                    </p>
                    <p>
                      <img class="lazyload" data-src="{{url('mobile/newImage/payment/bullet.svg')}}" alt="">
                      Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank) – Chi nhánh Nam Hà Nội
                    </p>
                  </div>
                </div>
              </div>
              <div id="bvd" class="tabcontent">
                <div class="bank-items-1">
                  <h2>Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV)</h2>
                  <div class="d-flex flex-column" style="gap: 9px">
                    <p>
                      <img class="lazyload" data-src="{{url('mobile/newImage/payment/bullet.svg')}}" alt="">
                      Số tài khoản:&nbsp;<strong>21610000601982</strong>
                    </p>
                    <p>
                      <img class="lazyload" data-src="{{url('mobile/newImage/payment/bullet.svg')}}" alt="">
                      Chủ tài khoản:&nbsp;<strong>Công ty cổ phần Vua Nệm</strong>
                    </p>
                    <p>
                      <img class="lazyload" data-src="{{url('mobile/newImage/payment/bullet.svg')}}" alt="">
                      Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV) – Chi nhánh Đống Đa Hà Nội
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </label>

          <label class="check-box payoo">
            <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_PAYOO}}">
            <span class="check"></span>
            <p>Trả góp bằng PAYOO (Thẻ tín dụng)</p>
          </label>
        </div>
        <button class="button-action style1 js-ga-click-payment" type="submit">
          <span>Thanh toán</span>
        </button>
      </form>
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

@push('scripts')
  <script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
  </script>
@endpush