<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.</title>
    <meta property="og:title" content="Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url("web/css/fonts.css")}}">
    <link rel="stylesheet" href="{{url("mobile/css/style.css")}}">
    <link rel="icon" type="image/png" href="{{url("mobile/image/favicon.png")}}"/>
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5Q55Z8B');
    </script>
</head>
<body>
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q55Z8B"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<div class="checkout-headers">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 header-logo">
                <a href="{{route("home")}}">
                    <h1>
                        <img src="{{url("mobile/image/homepage/logo.svg")}}">
                    </h1>
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    body .sc-main-left{border-bottom: 0;padding-bottom: 0;}
    .checkout-headers{padding-top:20px;}
    body .checkout-right{padding-top: 30px;}
    .header-logo a {
        text-decoration: none;
    }
</style>
<div class="checkout-main page-success">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 content-left">
                <div class="content-sc-top">
                  
                    <img src="{{url("web/image/icon-success.jpg")}}">
            <h6>Thanh toán thành công</h6>
            <div class="code-order js-ga-success-id" data-order-id="{{$order->id}}">Mã đơn hàng của bạn: {{$order->id}}</div>
            <div class="">Nhân viên dem.vn sẽ chủ động liên hệ với bạn trong thời gian sớm nhất</div>
            <div class="back-home">
                <a class="button-left" href="{{route("home")}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" >
                        <path d="M7.1546e-08 6.00027C6.8982e-08 6.21529 0.0842789 6.43031 0.252091 6.5943L5.53183 11.754C5.86746 12.082 6.41191 12.082 6.74828 11.754C7.08391 11.426 7.08391 10.8939 6.74828 10.5659L2.07639 6.00027L6.74828 1.43461C7.08391 1.10661 7.08391 0.574534 6.74828 0.246541C6.41266 -0.0821812 5.8682 -0.0821812 5.53183 0.246541L0.252091 5.40624C0.0842789 5.57024 7.41101e-08 5.78525 7.1546e-08 6.00027Z"/>
                        </svg> Quay lại trang chủ
                </a>
            </div>
                </div>
                <div class="sc-main-left">
                    <div class="sc-main-left-1">
                        <h3>Xác nhận thông tin</h3>
                        <div class="cols-1">
                            <p>
                                <span>Họ và tên</span> {{$order->user_name}}
                            </p>

                            <p>
                                <span>Số điện thoại</span> {{phone($order->phone_number)}}
                            </p>

                            <p>
                                <span>Tỉnh/thành phố</span> {{$order->province->name}}
                            </p>

                            <p>
                                <span>Quận/Huyện</span> {{$order->district->name}}
                            </p>

                            <p>
                                <span>Địa chỉ</span> {{$order->address}}
                            </p>
                        </div>
                    </div>
                    <div class="sc-main-left-2">
                        <h3>Hình thức thanh toán</h3>
                        <p>{{\App\Models\Orders::$paymentMethod[$order->payment_method]}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 checkout-right">
                <h3>Chi tiết đơn hàng</h3>
                <?php $totalAmount = 0; ?>
                @foreach($order->items as $item)
                    <div class="product-items js-ga-success-product-data"
                        data-product-id="{{$item->product_id}}"
                        data-product-name="{{$item->productVariant->name}}"
                        data-product-price="{{$item->price}}"
                        data-product-variant="{{$item->product_variant_id}}"
                        data-product-qty="{{$item->quantity}}">
                        <div class="image">
                            <img src="{{route("productImageShow", [
                            "id" => $item->product_id,
                            "size" => 340,
                            "fileName" => $item->productImages->first()->name])}}" alt="">
                        </div>
                        <div class="content-pr">
                            <h3>{{$item->productVariant->name}}</h3>
                            <p>{{$item->productVariant->width}}cm x {{$item->productVariant->length}}cm
                                x {{$item->productVariant->thickness}}cm</p>
                            <?php
                            $amount = $item->quantity * ($item->price - $item->promotion_discount);
                            $totalAmount += $amount;
                            ?>
                            <div class="price-pr mobile">
                                {{price($amount)}}đ
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="sc-right-bottom">
                    <div class="line line-2">
                        <span class="text">Phí vận chuyển</span>
                        <span class="price">Miễn phí</span>
                    </div>
                     <div class="line line-2">
                        <span class="text">Đổi trả</span>
                        <span class="price">6 tháng miễn phí</span>
                    </div>
                    <div class="line line-4">
                        <span class="text">Tạm tính</span>
                        <span class="price">{{price($totalAmount)}}đ</span>
                    </div>
                    @if(!empty($order->orderVoucher))
                        <div class="line line-5">
                            <span class="text">Voucher:</span>
                            <span class="price">{{price($order->orderVoucher->voucher_discount_value)}} đ</span>
                        </div>
                    @endif
                    <div class="line line-5">
                        <span class="text">Thành tiền</span>
                        <span class="price js-ga-success-total-amount" data-product-total-amount="{{$totalAmount}}">{{price($order->real_amount)}}đ</span>
                    </div>
                </div>
                <div class="image-bottom">
                    <img src="{{url("mobile/image/barcode.png")}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .back-home{text-align: center;padding-top: 15px;margin-bottom: 20px;}
     .button-left svg{
    fill: #6800BE;}
  .button-left {
        border: 1px solid #6800BE;
    border-radius: 10px;
    font-weight: 500;
    font-size: 18px;
    color: #6800BE;
    text-align: center;
    width: 200px;
    display: inline-flex;
    height: 45px;
    padding: 0 5px;
    line-height: 43px;
    align-items: center;
    justify-content: space-around;
}
</style>
<script type="text/javascript" src="{{url("/js/js_ga.js")}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>