@extends('layouts.mobile')
@section('content')
    <div class="main-page page-mini-cart">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 mini-cart-left">
                    <h3>Giỏ Hàng
                    </h3>
                    <?php $totalAmount = 0; ?>
                    @foreach(Cart::content() as $item)
                        <div class="product-items">
                            <div class="image">
                                <img src="{{$item->options->default_img}}" alt="">
                            <!-- <div class="input-group plus-minus-input">
                                        <div class="input-group-button">
                                            <button type="button" class="button hollow circle minus" onclick="qty('minus', '{{$item->rowId}}')">
                                                <span>-</span>
                                            </button>
                                            <input id="quantity" class="quantity_{{$item->rowId}}" type="text" name="quantity" min="1" max="5" class="qty-input" value="{{$item->qty}}">
                                            <button type="button" class="button hollow circle plus" onclick="qty('plus', '{{$item->rowId}}')">
                                                <span>+</span>
                                            </button>
                                        </div>
                                    </div> -->
                            </div>
                            <div class="info-product">
                                <div class="content-pr">
                                    <div class="header-block">
                                        <h3 class=name-product>{{$item->name}}</h3>
                                        <a href="{{route("cart.cartRemoveItem", ["itemId" => $item->rowId])}}"
                                           class="remove-item">Xoá</a>
                                    </div>
                                    <p class="option-product"><label class="label">Kích
                                            thước:</label> {{$item->options->width}} x {{$item->options->length}}cm</p>
                                    <p class="option-product"><label class="label">Độ
                                            dày: </label> {{$item->options->thickness}}cm</p>
                                    <p class="price-pr desktop"><label class="label">Giá: </label> <span class="price">{{price($item->price)}}đ</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php $totalAmount += ($item->price * $item->qty); ?>
                    @endforeach
                    @if($totalAmount == 0)
                        <p>Bạn chưa có sản phẩm nào trong giỏ hàng !</p>
                    @endif
                </div>
                <div class="col-sm-5 checkout-right">
                    @if($totalAmount > 0)

                        <div class="mini-cart-right">
                            <div class="sc-right-bottom">
                                <div class="line line-4">
                                    <span class="text">Tạm tính</span>
                                    <span class="price">{{price($totalAmount)}}đ</span>
                                </div>
                                <div class="line line-2">
                                    <span class="text">Phí vận chuyển</span>
                                    <span class="price">Miễn phí</span>
                                </div>
                                 <div class="line line-2">
                                    <span class="text">Đổi trả</span>
                                    <span class="price">6 tháng miễn phí</span>
                                </div>
                                <div class="line line-5">
                                    <span class="text">Tổng</span>
                                    <span class="price">{{price($totalAmount)}}đ</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('order.checkOut')}}" class="btn-page text-center">
                            Thanh toán
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
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
