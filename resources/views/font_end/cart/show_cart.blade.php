@extends('layouts.master')
@section('content')
    <div class="main-page page-mini-cart">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 mini-cart-left">
                    <h3>Giỏ Hàng <span>
                        <a href="{{route("cart.cartDestroy")}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                <g>
                                    <g>
                                        <path fill="#20315c"
                                              d="M14.314 13l10.3-10.3A.929.929 0 0 0 23.3 1.387L13 11.687 2.702 1.387A.928.928 0 1 0 1.388 2.7l10.3 10.3-10.3 10.3A.928.928 0 1 0 2.7 24.613l10.3-10.3 10.3 10.3a.926.926 0 0 0 1.313 0 .929.929 0 0 0 0-1.313z"/><path
                                                fill="none" stroke="#20315c" stroke-miterlimit="20"
                                                d="M14.314 13v0l10.3-10.3A.929.929 0 0 0 23.3 1.387L13 11.687v0L2.702 1.387A.928.928 0 1 0 1.388 2.7l10.3 10.3v0l-10.3 10.3A.928.928 0 1 0 2.7 24.613l10.3-10.3v0l10.3 10.3a.926.926 0 0 0 1.313 0 .929.929 0 0 0 0-1.313z"/>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </span>
                    </h3>
                    <?php $totalAmount = 0; ?>
                    @foreach(Cart::content() as $item)
                        <div class="product-items">
                            <div class="icon-close">
                                <a href="{{route("cart.cartRemoveItem", ["itemId" => $item->rowId])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                        <g>
                                            <g>
                                                <path fill="#20315c"
                                                      d="M14.314 13l10.3-10.3A.929.929 0 0 0 23.3 1.387L13 11.687 2.702 1.387A.928.928 0 1 0 1.388 2.7l10.3 10.3-10.3 10.3A.928.928 0 1 0 2.7 24.613l10.3-10.3 10.3 10.3a.926.926 0 0 0 1.313 0 .929.929 0 0 0 0-1.313z"/>
                                                <path fill="none" stroke="#20315c" stroke-miterlimit="20"
                                                      d="M14.314 13v0l10.3-10.3A.929.929 0 0 0 23.3 1.387L13 11.687v0L2.702 1.387A.928.928 0 1 0 1.388 2.7l10.3 10.3v0l-10.3 10.3A.928.928 0 1 0 2.7 24.613l10.3-10.3v0l10.3 10.3a.926.926 0 0 0 1.313 0 .929.929 0 0 0 0-1.313z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <div class="image">
                                <img src="{{$item->options->default_img}}" alt="">
                            </div>
                            <div class="content-pr">
                                <h3><a href="">{{$item->name}}</a></h3>
                                <p>{{$item->options->width}}cm x {{$item->options->length}}cm
                                    x {{$item->options->thickness}}cm</p>
                            </div>
                            <div class="price-pr desktop">
                                {{price($item->price)}}đ
                            </div>
                        </div>
                        <?php $totalAmount += ($item->price * $item->qty); ?>
                    @endforeach
                    @if($totalAmount == 0)
                        <p>Bạn chưa có sản phẩm nào trong giỏ hàng !</p>
                    @endif
                </div>
                <div class="col-sm-5 checkout-right">
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
                    @if($totalAmount > 0)
                        <a href="{{route('order.checkOut')}}" class="btn-page text-center">Thanh toán</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
