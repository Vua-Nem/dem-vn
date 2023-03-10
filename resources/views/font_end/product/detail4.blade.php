@extends('layouts.master')
@section('content')
    <div class="main-page">
        <div class="section-product">
            <div class="container">
                <div class="row js-ga-product-data"
                     data-product-name="{{$product->name}}"
                     data-product-id="{{$product->id}}"
                     data-product-price="{{$product->price}}"
                     data-product-brand="{{$product->brand->name}}">
                    <div class="col-md-7 image-product-wapper">
                        <div id="product-images">
                            <?php $i = 0; ?>
                            @foreach($product->variants as $variant)
                                @if($variant->compare_price > $variant->price)
                                    <div id="discount_percent_{{$variant->id}}"
                                         class="discount-percent @if($i == 0){{"active"}}@endif">
                                        -{{round((($variant->compare_price - $variant->price) / $variant->compare_price) * 100)}}%
                                    </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach
                            <div class="label-product style3">Best seller</div>
                            <div id="main-image-product" class="carousel slide" data-ride="carousel" align="center">
                                <div class="carousel-wapper">
                                    <div class="carousel-inner">
                                        <?php $i = 1; ?>
                                        @if($product->video_url !== '#')
                                            <div class="carousel-item active" data-index="1">
                                                <img src="{{url("/web/image/detail/massage/massage-cover-large.jpg")}}">
                                                <?php $i++; ?>
                                            </div>
                                        @endif
                                        @foreach($product->images as $img)
                                            <div class="carousel-item @if($i == 1) active @endif"
                                                 data-index="<?php echo $i; ?>">
                                                <img class="@if($i > 1){{"lazyload"}}@endif" @if($i> 1)
                                                data-src="{{route("productImageShow", ["id" => $product->id, "size" => 609, "fileName" => $img->name])}}"
                                                     @else
                                                     src="{{route("productImageShow", ["id" => $product->id, "size" => 609, "fileName" => $img->name])}}"
                                                        @endif
                                                >
                                            </div>
                                            <?php $i++; ?>
                                        @endforeach
                                    </div>
                                    <a class=" carousel-control-prev left carousel-control" href="#main-image-product"
                                       data-slide="prev"><span></span></a>
                                    <a class="carousel-control-next right carousel-control" href="#main-image-product"
                                       data-slide="next"><span></span></a>
                                </div>
                                <ol id="lightgallery-detail" class="carousel-indicators list-inline">
                                    <?php $i = 1; ?>
                                    @if($product->video_url !== '#')
                                        <li class="items-image-1" href="{{$product->video_url}}">
                                            <img src="{{url("/web/image/detail/massage/massage-thumb-small.jpg")}}"/>
                                        </li>
                                        <?php $i++; ?>
                                    @endif
                                    @foreach($product->images as $img)
                                        <li class="items-image-<?php echo $i ?>"
                                            href="{{route("showImage2", ["folder" => "products","id" => $product->id, "fileName" => $img->name])}}"
                                            @if ($i> 5)style="display: none;" @endif>
                                            <img src="{{route("productImageShow", ["id" => $product->id,"size"=>609, "fileName" => $img->name])}}">
                                        </li>
                                        <?php $i++; ?>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                        <div class="list-icon-pr">
                            <ul>
                                <li>
                                    <a href="/chinh-sach#cs1" target="_blank">
                                        <span class="icon"><img src="{{url("/web/image/icon-3.svg")}}" alt=""/></span>
                                        <p>6 th??ng<br>?????i tr???</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="/chinh-sach#cs4" target="_blank">
                                        <span class="icon"><img src="{{url("/web/image/icon-2.svg")}}" alt=""/></span>
                                        <p>Mi???n ph??<br>v???n chuy???n</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="/chinh-sach#cs1" target="_blank">
                                        <span class="icon"><img src="{{url("/web/image/icon-5.svg")}}" alt=""/></span>
                                        <p>Mi???n ph??<br>?????i tr???</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="/chinh-sach#cs5" target="_blank">
                                        <span class="icon"><img src="{{url("/web/image/ic-warranty.svg")}}"
                                                                alt=""/></span>
                                        <p>B???o h??nh<br>5 n??m</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="certificate-block">
                            <div class="title-certificate">Ch???ng ch???</div>
                            <div class="list-certificate">
                                <div class="item-certificate">
                                    <div class="image-certificate">
                                        <img class="lazyload" data-src="{{url("web/image/okeko-tex.jpg")}}">
                                    </div>
                                    <div class="tooltip-certificate">
                                        ????y l?? ch???ng ch??? trong d???t may, ?????m b???o lo???i b??? c??c ch???t g??y ???nh h?????ng ?????n s???c
                                        kh???e ng?????i d??ng nh?? formaldehyde, thu???c tr??? s??u, kim lo???i n???ng chi???t xu???t ???????c,
                                        c??c ch???t d???n g???c chlor h???u c?? v?? c??c ch???t b???o qu???n nh?? tetra ??? v??
                                        pentachlorophenol???
                                    </div>
                                </div>
                                <div class="item-certificate">
                                    <div class="image-certificate">
                                        <img class="lazyload" data-src="{{url("web/image/ISO.jpg")}}">
                                    </div>
                                    <div class="tooltip-certificate">
                                        ISO 45001 l?? m???t h??? th???ng qu???n l?? an to??n v?? s???c kh???e ngh??? nghi???p, cung c???p c??c
                                        ti??u ch?? v?? khu??n kh??? ????? c???i thi???n an to??n lao ?????ng, gi???m thi???u r???i ro t???i n??i
                                        l??m vi???c v?? t???o ??i???u ki???n l??m vi???c an to??n h??n
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="compare-link" href="/so-sanh/{{$product->slug}}">So s??nh v???i c??c lo???i ?????m kh??c</a>
                    </div>
                    <div class="col-md-5">
                        <form id="add-to-cart" method="post" action="{{route("cart.addcart")}}">
                            {{csrf_field()}}
                            <div class="product-wapper">
                                <h2>{{$product->name}}</h2>
                                <div class="section-review-pr">
                                    <div class="review-pr">
                                        <a href="#reviews-slide">
                                            <span>4.5</span> <img src="{{url("/web/image/star-halt.svg")}}" alt=""/>
                                            <span class="count-review">{{$reviews->count()}} ????nh gi??</span>
                                        </a>
                                    </div>
                                    <div class="count-pl">{{$product->total_sale}} ???? b??n</div>
                                </div>
                                <?php $i = 0; ?>
                                @foreach($product->variants as $variant)
                                    <div id="price_{{$variant->id}}"
                                         class="product-price @if($i == 0){{"active"}}@endif">
                                <span class="ga-product-price" data-price="{{$variant->price}}"
                                      data-sku="{{$variant->sku}}">
                                    {{price($variant->price)}}??
                                </span>
                                        @if($variant->compare_price > $variant->price)
                                            <span class="old">
                                    {{price($variant->compare_price)}}??
                                </span>
                                        @endif
                                    </div>
                                    <?php $i++; ?>
                                @endforeach
                                <div class="description">{!!$product->description->description!!}</div>
                                {{ Widget::run('showCountDown', ["entity_id" => $product->id, "entity_type" => "2"]) }}
                                <div class="variant-product-wapper display-flex">
                                    <?php $i = 0; ?>
                                    @foreach($attributeName as $keyCode => $name)
                                        <div class="variant-items {{$keyCode}}">
                                            <div class="title-variant">
                                                Ch???n {{$name}}:
                                                <span class="hidden {{$keyCode}}">Vui l??ng ch???n {{$name}}</span>
                                            </div>
                                            @if($i == 0)
                                                <ul class="attribute-group-name">
                                                    <?php $gCount = 0; ?>
                                                    @foreach($attributeGroup as $key => $value)
                                                        <li class="@if($gCount == 0) {{"active"}}@endif"
                                                            id="{{\Illuminate\Support\Str::slug($key, "_")}}">{{$key}}</li>
                                                        <?php $gCount++; ?>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if($i == 1)
                                                <?php $gCount = 0; ?>
                                                <div class="product_variant_option">
                                                    @foreach($attributeGroup as $key => $values)
                                                        <ul class="{{\Illuminate\Support\Str::slug($key, "_")}} @if($gCount == 0){{"active"}}@endif mb-0">
                                                            @foreach($values as $key => $value)
                                                                <li class="@if($gCount == 0) {{"active"}}@endif">
                                                                    {{$value}}
                                                                    <input type="radio" @if($gCount==0) checked
                                                                           @endif class="product_variant"
                                                                           name="product_variant" value="{{$key}}">
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <?php $gCount++; ?>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php $i++; ?>
                                    @endforeach

                                    <div class="number-qty">
                                        <div class="plus-minus-box">
                                            <label for="input-group-field" class="label-status">
                                                S??? l?????ng
                                            </label>
                                            <div class="input-group plus-minus-input">
                                                <div class="input-group-button">
                                                    <button type="button" class="button hollow circle minus">
                                                        -
                                                    </button>
                                                    <input id="quantity" type="text" name="quantity" min="1" max="5"
                                                           class="qty-input" value="1">
                                                    <button type="button" class="button hollow circle plus">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{ Widget::run('showVoucher') }}
                                <div class="sale-products">
                                    {{ Widget::run('notifySale', ["product_id" => $product->id]) }}
                                    {{ Widget::run('productBundles',["entity_product_id" => $product->id]) }}
                                </div>
                                <div class="button-action row">
                                    {{--<div class="col-md-6">--}}
                                    {{--<a class="call-now" href="tel:18002095">G???i tr???c ti???p</a>--}}
                                    {{--<div class="pr-call">--}}
                                    {{--<img src="{{url("web/image/label-hot.svg")}}">--}}
                                    {{--<a class="call-nows" href="tel:18002095">--}}
                                    {{--G???i 1800 2095 ??u ????i <br><b>Mua 1 ?????m, T???ng 1 ?????m</b></a>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="">
                                        <button class="add-to-cart js-ga-add-to-cart" type="button"
                                                data-product-name="{{$product->name}}"
                                                data-product-id="{{$product->id}}"
                                                data-product-price="{{$product->price}}"
                                                data-product-brand="{{$product->brand->name}}"
                                                data-product-variant="">Mua ngay
                                        </button>
                                        <p class="desc">Bao g???m chuy???n kho???n, thanh to??n VNPAY</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!$reviews->isEmpty())
        <?php $a = 1; ?>
        <div class="section-testimonial section-homepage" id="reviews-slide">
            <h3 class="title-section">????nh gi?? c???a kh??ch h??ng v??? <br> {{$product->name}}</h3>
            <div class="content-section ">
                <div id="testimonialCarousel" class="review-section">
                    @foreach($reviews as $review)
                        <div class="review-items">
                            <div class="feedback-customer">
                                <div class="customer-name">{{ $review->getUser->name }}</div>
                                <p>{{$review->content}}</p>
                            </div>
                            <div class="col-right">
                                @isset($review->reviewImage)
                                    <div class="image image-review" data-index="{{$a}}"
                                         style="background: url('{{url("image/reviews/" .$review->id ."/" . $review->reviewImage->file_name)}}')"></div>
                                @endisset
                                <div class="content-title">
                                    <div class="title">{{ $review->getProduct->name}}</div>
                                </div>
                            </div>
                        </div>
                        <?php $a++; ?>
                    @endforeach
                </div>
            </div>
        </div>
        <ol id="lightgallery-review" style="display: none">
            <?php $i = 1; ?>
            @foreach($reviews as $review)
                @isset($review->reviewImage)
                    <li data-sub-html="{{ $review->getUser->name }}</h4><p>{{$review->content}}</p>"
                        class="items-image-<?php echo $i ?>"
                        href="{{url("image/reviews/" .$review->id ."/" . $review->reviewImage->file_name)}}">
                        <img src="{{url("image/reviews/" .$review->id ."/" . $review->reviewImage->file_name)}}">
                    </li>
                @endisset
                <?php $i++; ?>
            @endforeach
        </ol>
    @endif
    <div class="section-image">
        <div class="container">
            <img class="lazyload" data-src="{{url("web/image/detail/massage/g9-banner.png")}}">
        </div>
    </div>
    <div class="section-background-image">
        <div class="container text-center">
            <div class="content-wapper">
                <h4 class="text-center">V?? sao ?????m Massage Goodnight l?? <br> s??? l???a ch???n t???i ??u d??nh cho b???n</h4>
                <ul>
                    <li>?????m ???????c s???n xu???t b???i t???p ??o??n Inoac Nh???t B???n v???i c??ng ngh??? hi???n ?????i h??ng ?????u th??? gi???i</li>
                    <li>?????m ???????c b??n tr???c tuy???n t???i Dem.vn, c???t gi???m chi ph?? cho c??c c???a h??ng ph??n ph???i</li>
                    <li>H???n ch??? t???i ??a c??c lo???i ph??? ph?? cho kho b??i, v???n chuy???n</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section-feature">
        <div class="container">
            <h3 class="text-center">Y??n t??m tr???i nghi???m gi???c ng??? ch???t l?????ng <br>c??ng Massage Goodnight</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-items">
                        <img class="lazyload" data-src="{{url("web/image/detail/massage/g9-4block1.png")}}">
                        <div class="content-items">
                            <h4>??i???u ho?? th??n nhi???t</h4>
                            <p>B??? m???t profile cutting t???o n??n nh???ng kho???ng tr???ng gi???a c?? th??? ng?????i s??? d???ng v?? t???m n???m
                                gi??p kh??ng kh?? v?? nhi???t ????? d??? d??ng l??u th??ng, khu???ch t??n m??? h??i v?? ????? ???m.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-items">
                        <img class="lazyload" data-src="{{url("web/image/detail/massage/g9-4block2.png")}}">
                        <div class="content-items">
                            <h4>C???u tr??c l?????n s??ng</h4>
                            <p>L???p l??i PU Foam c???a ?????m c?? ????? ????n h???i v?? ????? ??m ??i cao, gi??p duy tr?? t?? th??? t??? nhi??n c???a
                                c???t s???ng. S???n ph???m s??? h???u ????? d??y 9cm ??? ????? d??y l?? t?????ng ????? h??? tr??? c?? th??? ???n ?????nh</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-items">
                        <img class="lazyload" data-src="{{url("web/image/detail/massage/g9-4block3.png")}}">
                        <div class="content-items">
                            <h4>V??? ?????m Tho??ng kh??</h4>
                            <p>V??? ?????m l?? s??? k???t h???p c???a l???p v???i thun m???m m???i c??ng v???i l???p v???i l?????i 3D th??ng tho??ng ???????c
                                thi???t k??? ??? v??? tr?? vai v?? g??y, h???n ch??? t??nh tr???ng ????? m??? h??i trong l??c ng???.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-items">
                        <img class="lazyload" data-src="{{url("web/image/detail/massage/g9-4block4.png")}}">
                        <div class="content-items">
                            <h4>Ch???t l?????ng Nh???t B???n</h4>
                            <p>S??? d???ng ngu???n nguy??n li???u foam cao c???p, ???????c s???n xu???t d?????i d??y chuy???n c??ng ngh??? hi???n ?????i
                                h??ng ?????u th??? gi???i theo ti??u chu???n ch???t l?????ng kh???t khe c???a Nh???t B???n .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="features-product">
        <div class="container">
            <div class="content-wapper">
                <h4><span><svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28"
                               fill="none">
                        <line x1="6.75" y1="7.25" x2="25.25" y2="7.25" stroke="#410077" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="6.75" y1="14.25" x2="18.25" y2="14.25" stroke="#410077" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="6.75" y1="21.25" x2="22.25" y2="21.25" stroke="#410077" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="0.5" y="0.5" width="30" height="27" rx="3.5" stroke="#410077"/>
                    </svg>
                </span>
                    ?????c ??i???m s???n ph???m
                    <span class="icon-right" style="padding-left: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="10" viewBox="0 0 16 10" fill="none">
                        <path d="M8.00073 9.50048C8.28744 9.50048 8.57414 9.39212 8.79281 9.17635L15.6727 2.38775C16.1101 1.95621 16.1101 1.25615 15.6727 0.823655C15.2354 0.392115 14.5259 0.392115 14.0886 0.823655L8.00073 6.83069L1.9129 0.823654C1.47556 0.392114 0.766091 0.392114 0.328747 0.823653C-0.109569 1.25519 -0.109569 1.95525 0.328747 2.38775L7.20865 9.17635C7.42733 9.39211 7.71403 9.50048 8.00073 9.50048Z"
                              fill="#000F40"/>
                    </svg>
                </span>
                </h4>
                <div class="list-features row">
                    <div class="col-md-4">
                        <p>Ch???t li???u: Foam PU</p>
                        <p>????? c???ng m???m: 6</p>
                    </div>
                    <div class="col-md-4">
                        <p>Th???i gian b???o h??nh: 5 n??m</p>
                        <p>Xu???t x???: Vi???t Nam</p>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-list-right">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <img class="lazyload" data-src="{{url("web/image/detail/massage/g9.png")}}">
                </div>
                <div class="col-md-5">
                    <ul>
                        <li>
                            <div class="image"><img class="lazyload" data-src="{{url("web/image/list-31.png")}}"></div>
                            <div class="content">
                                <h5>Ch???ng ch??? OEKO-TEX Standard 100</h5>
                                <p>????y l?? ch???ng ch??? trong d???t may, ?????m b???o lo???i b??? c??c ch???t g??y ???nh h?????ng ?????n s???c kh???e
                                    ng?????i d??ng nh?? formaldehyde, thu???c tr??? s??u, kim lo???i n???ng chi???t xu???t ???????c, c??c ch???t
                                    d???n g???c chlor h???u c?? v?? c??c ch???t b???o qu???n nh?? tetra ??? v?? pentachlorophenol???</p>
                            </div>
                        </li>
                        <li>
                            <div class="image"><img class="lazyload" data-src="{{url("web/image/certificate5.png")}}">
                            </div>
                            <div class="content">
                                <h5>Ch???ng ch??? ISO 45001</h5>
                                <p>ISO 45001 l?? m???t h??? th???ng qu???n l?? an to??n v?? s???c kh???e ngh??? nghi???p, cung c???p c??c ti??u
                                    ch?? v?? khu??n kh??? ????? c???i thi???n an to??n lao ?????ng, gi???m thi???u r???i ro t???i n??i l??m vi???c
                                    v?? t???o ??i???u ki???n l??m vi???c an to??n h??n</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if($product->video_url !== '#')
        <div class="section-bg-bottom">
            <div class="section-video">
                <div class="container">
                    <h3 class="text-center">M??? h???p s???n ph???m trong v??i gi??y</h3>
                    <div class="row">
                        <div class="video-content col-md-12">
                            <iframe width="100%" height="500" src="{{$product->video_url}}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="section-feature-product section-detail" id="feature-product">
        <h2 class="title-section">Xem th??m c??c s???n ph???m kh??c</h2>
        <div class="content-section container-home">
            <div class="items-product display-flex">
                <?php $i = 0; ?>
                @foreach($relatedProducts as $product)
                    <div class="item">
                        <a href="{{route("product.detail", ["slug" => $product->slug])}}"
                           data-product-id="{{$product->id}}"
                           data-product-name="{{$product->name}}"
                           data-product-price="{{$product->price}}"
                           data-url="{{route("product.detail", ["slug" => $product->slug])}}"
                           class="js-gaee-product-data">
                            <div class="image-product">
                                @if($i == 0)
                                    <div class="label-product">Gi?? t???t nh???t</div>
                                @elseif ($i == 1)
                                    <div class="label-product">C??ng ngh??? M???</div>
                                @elseif ($i == 2)
                                    <div class="label-product">Best seller</div>
                                @endif
                                @if(!empty($product->images->first()))
                                    <img data-src="{{route("productImageShow", [
                                    "id" => $product->id,
                                    "size" => 609,
                                    "fileName" => $product->images->first()->name
                                    ])}}" alt="" class="image-product lazyload">
                                @else
                                    <img data-src="{{route("productImageShow", [
                                    "id" => $product->id,
                                    "size" => 609,
                                    "fileName" => "default.jpg"
                                    ])}}" alt="" class="image-product lazyload">
                                @endif
                                @if($product->compare_price > $product->price)
                                    <div class="discount-percent">
                                        -{{round((($product->compare_price - $product->price) / $product->compare_price) * 100)}}
                                        %
                                    </div>
                                @endif
                            </div>
                            <div class="title-product">{{$product->name}}</div>
                            <div class="price">
                                <span class="regular-price">{{price($product->price)}} ??</span>
                                @if($product->compare_price > $product->price)
                                    <span class="old-price">{{price($product->compare_price)}} ??</span>
                                @endif
                            </div>
                            <div class="button-action style2">
                                <span>Xem ngay</span>
                            </div>
                        </a>
                        <?php $i++; ?>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#lightgallery-detail, #lightgallery-review').lightGallery();

                $(".section-testimonial .image-review").click(function () {
                    var position = $(this).data("index");
                    $("#lightgallery-review .items-image-" + position).click();
                });
                // Active when choose variants
                $(".attribute-group-name li").click(function () {
                    $(".attribute-group-name, .product_variant_option").removeClass("error_variant");
                    $(".title-variant span").addClass("hidden");
                    const activeGroup = $(this).attr("id");
                    $(".attribute-group-name li").removeClass("active");
                    $(this).addClass("active");
                    $(".product_variant_option ul").removeClass("active");
                    $("." + activeGroup).addClass("active");
                    $("input[name='product_variant']").removeAttr('checked');
                    $(".product_variant_option li").removeClass("active");
                    $("." + activeGroup).children(":first").trigger("click");

                    const priceProduct = $(".product-price.active .ga-product-price").attr("data-price");
                    const variantProduct = $(".product-price.active .ga-product-price").attr("data-sku");
                    $(".js-ga-add-to-cart").attr({
                        'data-product-price': priceProduct,
                        'data-product-variant': variantProduct
                    });
                });

                $(".product_variant_option ul li").click(function () {
                    $(".attribute-group-name, .product_variant_option").removeClass("error_variant");
                    $(".title-variant span").addClass("hidden");
                    $(".product_variant_option ul li").removeClass("active");
                    $(this).addClass("active");
                    $(this).children("input").prop("checked", true);
                    const variantId = $(this).children("input").val();
                    $(".product-price, .discount-percent").removeClass("active");
                    $("#price_" + variantId).addClass("active");
                    $("#discount_percent_" + variantId).addClass("active");

                    const priceProduct = $(".product-price.active .ga-product-price").attr("data-price");
                    const variantProduct = $(".product-price.active .ga-product-price").attr("data-sku");
                    $(".js-ga-add-to-cart").attr({
                        'data-product-price': priceProduct,
                        'data-product-variant': variantProduct
                    });
                });
                // End active when choose variants

                // Open lightbox by id
                $("#main-image-product .carousel-item").click(function () {
                    var index = $(this).data("index");
                    $(".items-image-" + index).click();
                });
                // End open lightbox by id

                // Add to cart
                $(".add-to-cart").click(function () {
                    var productVariant = document.getElementsByName('product_variant');
                    var errorVariant = false;

                    if (!$(".attribute-group-name li").hasClass("active")) {
                        $(".KICH_THUOC").removeClass("hidden");
                        $(".attribute-group-name").addClass("error_variant");
                        errorVariant = true;
                    }

                    if (!$(".product_variant_option li").hasClass("active")) {
                        $(".DO_DAY").removeClass("hidden");
                        $(".product_variant_option").addClass("error_variant");
                        errorVariant = true;
                    }

                    if (errorVariant === false) {
                        for (i = 0; i < productVariant.length; i++) {
                            if (productVariant[i].checked) {
                                $("#add-to-cart").submit();
                                break;
                            }
                        }
                    }
                });
                // End add to cart

                //qty
                $(".button.plus").click(function () {
                    var currentQty = document.getElementById("quantity");
                    if (currentQty.value < 5) {
                        currentQty = currentQty.value++;
                    }
                });
                $(".button.minus").click(function () {
                    var currentQty = document.getElementById("quantity");
                    if (currentQty.value > 1) {
                        currentQty = currentQty.value--;
                    }
                });

                $(".product_variant_option ul.active").children(":first").trigger("click");
            });
        </script>
    @endpush
    @if (Session::get('addToCart'))
        @push('scripts')
            <script type="text/javascript">
                $('#mini-cart, .overlay, body').addClass('active');
            </script>
        @endpush
    @endif
    @push('scripts')
        <script type="text/javascript">
            let valueChecked = $('input[name="product_variant_attach"]:checked').val();
            $('.sale-products input').click(function () {
                let valueChecked2 = $('input[name="product_variant_attach"]:checked').val();
                if (valueChecked === valueChecked2) {
                    $(this).prop("checked", false);
                    valueChecked = 0;
                } else {
                    valueChecked = valueChecked2;
                }
            });
        </script>
    @endpush
@endsection
