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
                                                <img src="{{url("/web/image/detail/galaxy/galaxy-cover-large.jpg")}}">
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
                                            <img src="{{url("/web/image/detail/galaxy/galaxy-thumb-small.jpg")}}"/>
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
                                        kh???e
                                        ng?????i d??ng nh?? formaldehyde, thu???c tr??? s??u, kim lo???i n???ng chi???t xu???t ???????c, c??c
                                        ch???t
                                        d???n g???c chlor h???u c?? v?? c??c ch???t b???o qu???n nh?? tetra ??? v?? pentachlorophenol???
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
    <div class="section-image" style="">
        <div class="container ">
            <img class="lazyload" data-src="{{url("web/image/block-top3.png")}}">
        </div>
    </div>
    <div class="section-background-image">
        <div class="container text-center">
            <div class="content-wapper">
                <h4 class="text-center">V?? sao ?????m Goodnight Galaxy - Green Tea <br>c?? m???c gi?? h???p d???n ?????n v???y?</h4>
                <ul>
                    <li>?????m ???????c nh???p kh???u nguy??n li???u, s???n xu???t v?? ph??n ph???i tr???c ti???p b???i Dem.vn
                    </li>
                    <li>?????m ???????c b??n tr???c tuy???n t???i Dem.vn, c???t gi???m chi ph?? cho c??c c???a h??ng ph??n ph???i</li>
                    <li>H???n ch??? t???i ??a c??c lo???i ph??? ph?? cho kho b??i, v???n chuy???n</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section-feature">
        <div class="container">
            <h3 class="text-center">Y??n t??m tr???i nghi???m gi???c ng??? ch???t l?????ng <br>c??ng Goodnight Galaxy - Green Tea</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-items">
                        <img class="lazyload" data-src="{{url("web/image/grid-31.jpg")}}">
                        <div class="content-items">
                            <h4>Kh??? n??ng n??ng ????? c?? th??? v?????t tr???i</h4>
                            <p>L??i foam tr?? xanh c?? ????? ????n h???i t???t, ????? c???ng m???m v???a ph???i. Khi b???n th??? nh??? c?? th??? tr??n
                                ?????m, l???p foam tr?? xanh ho???t t??nh ch???m r??i ??m s??t l???y t???ng ???????ng cong, nh??? nh??ng n??ng niu
                                c?? th??? b???n. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-items">
                        <img class="lazyload" data-src="{{url("web/image/grid-32.jpg")}}">
                        <div class="content-items">
                            <h4>Nguy??n li???u s???ch & an to??n</h4>
                            <p>Ch???t li???u foam tra?? xanh ho???t t??nh co?? kha?? n??ng kh???? ?????? ????m, tra??nh vi khu????n n????m m????c
                                hi????u qua??, an toa??n cho ng??????i l????n va?? tre?? em</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-items">
                        <img class="lazyload" data-src="{{url("web/image/grid-33.jpg")}}">
                        <div class="content-items">
                            <h4>V??? b???c sang tr???ng m???m m???i cho l??n da</h4>
                            <p>V??? b???c ???????c l??m t??? v???i thun tho??ng kh??. Lo???i v???i n??y gi??p ?????m duy tr?? h??nh d??ng, cho c???m
                                gi??c m?????t m?? m???i khi b???n tr??? m??nh. B??? m???t v???i ???????c thi???t k??? gi??p l??u th??ng kh??, tho??ng
                                m??t, m???m m???i v???i c??? l??n da ng?????i l???n v?? em b??.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-items">
                        <img class="lazyload" data-src="{{url("web/image/grid-34.jpg")}}">
                        <div class="content-items">
                            <h4>????? d??y ?????m l?? t?????ng</h4>
                            <p>????? d??y 12cm v???a v???n v???i m???i chi???c gi?????ng, ph?? h???p v???i ng?????i l???n tu???i mong mu???n n???m ng???
                                tr??n chi???c ?????m c?? ????? cao v???a ph???i.</p>
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
                        <p>Ch???t li???u: Foam tr?? xanh</p>
                        <p>????? c???ng m???m: 7</p>
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
                    <img class="lazyload" data-src="{{url("web/image/grid-35.jpg")}}">
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
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="section-image-text section-01">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{url("web/image/grid-36.jpg")}}"/>
                </div>
                <div class="col-md-6 content-block">
                    <h4>An to??n ngay c??? v???i nh???ng gia ????nh c?? tr??? nh???</h4>
                    <p>?????m foam Goodnight Galaxy Green Tea c?? l??i foam tr?? xanh l??nh t??nh, kh??ng ???m, kh??ng khu???n. V??? ?????m
                        s??ng m??u gi??p xua ??u???i c??n tr??ng v?? d??? d??ng ph??t hi???n v???t b???n.</p>
                    <div class="view-button">
                        <a href="#">Ng??? ngon h??n</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-image-text  section-012 ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 content-block">
                    <h4>D??? d??ng v???n chuy???n trong kh??ng gian h???p</h4>
                    <p>?????m foam Goodnight Galaxy Green Tea l?? ?????m foam m???t t???m, c?? th??? cu???n h??t ch??n kh??ng si??u nh??? g???n.
                        D?? c???u thang hay c??n ph??ng c???a b???n c?? k??ch th?????c ra sao, Dem.vn ho??n to??n c?? th??? v???n chuy???n ?????m
                        ?????n t???n ph??ng ng??? c???a b???n</p>
                    <div class="view-button">
                        <a href="#">Ng??? ngon h??n</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{url("web/image/grid-37.jpg")}}"/>
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
