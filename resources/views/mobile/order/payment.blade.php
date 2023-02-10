@extends('layouts.mobile-no-footer')
@section('content')
    <div class="checkout-main page-payment">
    <?php $totalAmount = 0; ?>
    @foreach(Cart::content() as $item)
        <?php $totalAmount += ($item->price * $item->qty); ?>
        <div class="product-items js-ga-checkout-product-data {{$item->rowId}}"
            data-product-id="{{explode("_", $item->id)[0]}}"
            data-product-name="{{$item->name}}"
            data-product-price="{{$item->price}}"
            data-product-variant="{{$item->options->sku}}"
            data-product-qty="{{$item->qty}}">
        </div>
    @endforeach

    <?php $totalDiscount = 0; ?>
    @foreach(Cart::instance('voucher')->content() as $voucher)
        <?php $totalDiscount += $voucher->price; ?>
    @endforeach
    <?php $totalAmount = $totalAmount - $totalDiscount; ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-12 checkout-right">
                    <div class="checkout-rights">
                        <div class="header-text">
                            <div class="label-cart"><img src="/mobile/image/homepage/icon-cart.svg"> Giỏ hàng <span class="count-cart">({{Cart::instance('default')->count()}})</span></div>
                            <div class="edit-cart active-cart">Chỉnh sửa</div>
                        </div>
                        <div class="limit-height">
                            <div class="total">
                                <p>Tổng</p>
                                <p class="total-amount js-ga-total" data-product-total-amount="{{$totalAmount}}">{{price($totalAmount)}}đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="show-content">
                        <div class="button-text"><span class="showall active-cart">Xem toàn bộ giỏ hàng</span> <svg xmlns="http://www.w3.org/2000/svg" width="9" height="15" viewBox="0 0 9 15">
                                    <g>
                                        <g>
                                            <path fill="#6800BE" d="M1.454 8.302l5.942 5.942a.495.495 0 0 0 .7-.7L2.505 7.951 8.096 2.36a.495.495 0 0 0-.7-.7L1.454 7.602a.495.495 0 0 0 0 .7z"></path>
                                            <path fill="none" stroke="#6800BE" stroke-miterlimit="20" d="M1.454 8.302v0l5.942 5.942a.495.495 0 0 0 .7-.7L2.505 7.951v0L8.096 2.36a.495.495 0 0 0-.7-.7L1.454 7.602a.495.495 0 0 0 0 .7z"></path>
                                        </g>
                                    </g>
                                </svg></div>
                            </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="content-left">

                        <div class="title-cart">1. Thông tin khách hàng <a href="{{route("order.checkOut")}}">Thay đổi</a></div>
                        <div class="table-infor">
                            <div class="line">
                                <div class="cols-1">Họ tên</div>
                                <div class="cols-2">{{$customer["full_name"]}}</div>

                            </div>
                            <div class="line">
                                <div class="cols-1">Số điện thoại</div>
                                <div class="cols-2">{{phone($customer["phone"])}}</div>

                            </div>
                            <div class="line">
                                <div class="cols-1">Địa chỉ</div>
                                <div class="cols-2">{{$customer["address"]}} - {{$district->name}} - {{$province->name}}</div>

                            </div>
                            <div class="line">
                                <div class="cols-1">Vận chuyển</div>
                                <div class="cols-2">Miễn phí</div>
                            </div>
                        </div>
                        <div class="title-cart mb-0">2. Thanh toán</div>
                        <p class="desc">Toàn bộ các giao dịch được bảo mật và mã hoá</p>
                        <form class="mb-50" method="post" action="{{route("order.saveOrder")}}">
                            {{csrf_field()}}
                            <label class="check-box cod">
                                <p>Nhận hàng và trả tiền (COD)</p>
                                <input type="radio" checked name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_COD}}">
                                <span class="check"></span>
                            </label>


                            <label class="check-box vnpay">
                                <p>Thanh toán bằng VNPAY (ATM / Internet Banking / MasterCard)</p>
                                <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_VNP}}">
                                <span class="check"></span>
                            </label>

                           <label class="check-box">
                            <p>Chuyển khoản ngân hàng</p>
                           <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_INTERNET_BANKING}}">
                            <span class="check"></span>
                            <div class="tabs-bank">
                                <div class="tabs">
                                  <div class="tablinks active" onclick="openCity(event, 'vcb')"><img src="{{url("web/image/bank-vietcombank.png")}}"></div>
                                  <div class="tablinks" onclick="openCity(event, 'bvd')"><img src="{{url("web/image/bank-biv.png")}}"></div>
                                </div>
                                <div id="vcb" class="tabcontent">
                                    <div class="bank-items-1">
                                        <p style="font-weight: 600;">Tài khoản Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank):</p>
                                        <p>– Số tài khoản: 0971.0000.15217</p>
                                        <p>– Chủ tài khoản: Công ty cổ phần Vua Nệm</p>
                                        <p>– Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank) – Chi nhánh Nam Hà Nội</p>
                                    </div>
                                </div>
                                <div id="bvd" class="tabcontent">
                                  <div class="bank-items-1">
                                        <p style="font-weight: 600;">Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV)</p>
                                        <p>– Số tài khoản: 21610000601982</p>
                                        <p>– Chủ tài khoản: Công ty cổ phần Vua Nệm</p>
                                        <p>– Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV) – Chi nhánh Đống Đa Hà Nội</p>
                                    </div>
                                </div>
                            </div>
                            </label>

                            <label class="check-box payoo" @if($totalAmount < 3000000)style="display: none"@endif>
                            <p>Trả góp bằng PAYOO (Thẻ tín dụng)</p>
                            <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_PAYOO}}">
                            <span class="check"></span>
                            </label>

                            <div class="checkout-left-bottom js-ga-click-payment">
                                <button class="btn-page" type="submit">
                                    Hoàn tất đơn hàng <svg xmlns="http://www.w3.org/2000/svg" width="9" height="15" viewBox="0 0 9 15">
                                    <g>
                                        <g>
                                            <path fill="#fff" d="M1.454 8.302l5.942 5.942a.495.495 0 0 0 .7-.7L2.505 7.951 8.096 2.36a.495.495 0 0 0-.7-.7L1.454 7.602a.495.495 0 0 0 0 .7z"></path>
                                            <path fill="none" stroke="#fff" stroke-miterlimit="20" d="M1.454 8.302v0l5.942 5.942a.495.495 0 0 0 .7-.7L2.505 7.951v0L8.096 2.36a.495.495 0 0 0-.7-.7L1.454 7.602a.495.495 0 0 0 0 .7z"></path>
                                        </g>
                                    </g>
                                </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
 <style type="text/css">
        .check-box input:checked ~ .tabs-bank{display: block;}
        body .check-box .check{top: 11px;}
        .tabs-bank{display: none;padding-top: 10px;}
      .tablinks.active:after{  width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid  rgba(236, 224, 245, 0.95);
        content: "";
        position: absolute;
        bottom: -17px;
        left: calc(50% - 10px); }
    #vcb.tabcontent{display: block;}
    .tabcontent{display: none;background: linear-gradient(180deg, #F7F4FF 11.41%, rgba(247, 244, 255, 0) 95.62%);
        border: 1px solid rgba(236, 224, 245, 0.95);padding: 10px 15px;    margin-top: 15px;
        box-sizing: border-box;color: #000F40;
        border-radius: 4px;}
        .tabs{display: flex}
        .tablinks img{max-width: 120px}
         .tablinks {padding:10px;border: 1px solid #eaeaea;margin-right: 15px;}
        .tablinks.active{border: 1px solid #6800BE;border-radius: 4px;position: relative;}

    </style>
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
<style>
    .hotline-phone-ring-wrap {
        display: none;
    }

    .header-cart,
    .main-menu,
    #mini-cart .button-active {
        display: none !important;
    }

    body .header-wapper .header-logo {
        width: 100%;
        padding: 10px
    }

    .checkout-right .total {
        border-top: 0px;
        margin-top: 0;
    }

    .voucher {
        font-size: 14px;
        line-height: 30px;
        color: #239b28;
        font-weight: 600;
        margin-top: 10px;
    }

    .voucher-info .remove-voucher {
        cursor: pointer;
        color: #0d6efd;
    }

    .error-voucher {
        color: #ff2c2c;
        padding-top: 10px;
    }
</style>
