@extends('layouts.mobile-no-footer')
@section('content')
    <?php if(session()->has('customer')) $customer = session()->get('customer'); ?>
    <div class="checkout-main page-checkout">
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
                <div class="col-sm-5 checkout-right">
                    <div class="header-text">
                        <div class="label-cart"><img src="/mobile/image/homepage/icon-cart.svg"> Giỏ hàng <span class="count-cart">({{Cart::instance('default')->count()}})</span></div>
                        <div class="edit-cart active-cart">Chỉnh sửa</div>
                    </div>
                    <div class="limit-height">
                        <div class="total">
                            <p>Tổng</p>
                            <p class="total-amount">{{price($totalAmount)}}đ</p>
                        </div>
                    </div>
                    <div class="show-content">
                        <div class="button-text"><span class="showall active-cart">Xem toàn bộ giỏ hàng</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="15" viewBox="0 0 9 15">
                                <g>
                                    <g>
                                        <path fill="#6800BE"
                                              d="M1.454 8.302l5.942 5.942a.495.495 0 0 0 .7-.7L2.505 7.951 8.096 2.36a.495.495 0 0 0-.7-.7L1.454 7.602a.495.495 0 0 0 0 .7z"></path>
                                        <path fill="none" stroke="#6800BE" stroke-miterlimit="20"
                                              d="M1.454 8.302v0l5.942 5.942a.495.495 0 0 0 .7-.7L2.505 7.951v0L8.096 2.36a.495.495 0 0 0-.7-.7L1.454 7.602a.495.495 0 0 0 0 .7z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 content-left">
                    <form class="form-info" method="post" action="{{route("order.customer")}}">
                        {{csrf_field()}}
                        <h2>1. Thông tin khách hàng</h2>
                        <div class="form-group">
                            <label>Số điện thoại <em>*</em></label>
                            @if($errors->has('phone_errors'))
                                <span class="error-message">{{ $errors->first('phone_errors') }}</span>@endif

                            <input type="text" name="phone" id="phone" class="form-control" placeholder=""
                        </div>
                        <div class="form-group">
                            <label>Họ và tên <em>*</em></label>
                            @if ($errors->has('full_name'))
                                <span class="error-message">{{ $errors->first('full_name') }}</span>
                            @endif
                        <input type="text" name="full_name" id="full_name" class="form-control @if($errors->has('full_name')) error @endif" placeholder=""
                                   value="@if(isset($customer["full_name"])) {{$customer["full_name"]}}@endif">
                        </div>
                        <div class="form-group">
                            <label>Email <em>*</em></label>
                            @if ($errors->has('email'))
                                <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                            <input type="text" name="email" id="email" class="form-control @if($errors->has('email')) error @endif" placeholder=""
                                   value="@if(isset($customer["email"])) {{$customer["email"]}}@endif">
                        </div>
                        <div class="form-group">
                            <label>Tỉnh/Thành phố <em>*</em></label>
                            @if ($errors->has('province_id'))
                                <span class="error-message">{{ $errors->first('province_id') }}</span>
                            @endif
                            <select name="province_id" id="province" class="form-control @if($errors->has('province_id')) error @endif">
                                @foreach($provinces as $province)
                                    <option @if(isset($customer["province_id"]) && $customer["province_id"] == $province->id) selected
                                            @endif
                                            value="{{$province->id}}">{{$province->name}}</checkout-main
                                        page-checkoutoption>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quận/Huyện <em>*</em></label>
                            @if ($errors->has('district_id'))
                                <span class="error-message">{{ $errors->first('district_id') }}</span>
                            @endif
                            <select id="district" name="district_id" class="form-control @if($errors->has('district')) error @endif">
                                @if(!empty($districts))
                                    @foreach($districts as $district)
                                        <option @if(isset($customer["district_id"]) && $customer["district_id"] == $district->id) selected
                                                @endif
                                                value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                @else
                                    <option>Quận/Huyện</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group mb-50">
                            <label>Địa chỉ <em>*</em></label>
                            @if ($errors->has('address'))
                                <span class="error-message">{{ $errors->first('address') }}</span>
                            @endif
                            <input name="address" id="address" class="form-control @if($errors->has('address')) error @endif"
                                   value="@if(isset($customer["address"])) {{$customer["address"]}}@endif"
                                   placeholder="">
                        </div>

                        <div class="checkout-left-bottom ">

                            <button type="submit" class="btn-page js-ga-click-address">Chuyển đến phần thanh toán
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="15" viewBox="0 0 9 15">
                                    <g>
                                        <g>
                                            <path fill="#fff"
                                                  d="M1.454 8.302l5.942 5.942a.495.495 0 0 0 .7-.7L2.505 7.951 8.096 2.36a.495.495 0 0 0-.7-.7L1.454 7.602a.495.495 0 0 0 0 .7z"></path>
                                            <path fill="none" stroke="#fff" stroke-miterlimit="20"
                                                  d="M1.454 8.302v0l5.942 5.942a.495.495 0 0 0 .7-.7L2.505 7.951v0L8.096 2.36a.495.495 0 0 0-.7-.7L1.454 7.602a.495.495 0 0 0 0 .7z"></path>
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
@endsection
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
