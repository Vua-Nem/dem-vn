@extends('layouts.mobile-no-footer')
@section('content')
    <div class="product-detail-page js-ga-product-data"
         data-product-name="{{$product->name}}"
         data-product-id="{{$product->id}}"
         data-product-price="{{$product->price}}"
         data-product-brand="{{$product->brand->name}}">
        <div class="main-page line-bottom">
            <div class="section-product">
                <div class="image-product-wapper">
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
                        <div class="label-product">Giá tốt nhất</div>
                        <div id="main-image-product" class="carousel slide" data-ride="carousel" align="center">
                            <div class="carousel-wapper">
                                <div class="carousel-inner">
                                    <?php $i = 1; ?>
                                    @if($product->video_url !== '#')
                                        <div class="carousel-item active" data-index="1">
                                            <img src="{{url("/web/image/detail/eva/eva-cover-large.jpg")}}">
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
                                <a class="carousel-control-prev left carousel-control" href="#main-image-product"
                                   data-slide="prev"><span></span></a>
                                <a class="carousel-control-next right carousel-control" href="#main-image-product"
                                   data-slide="next"><span></span></a>
                            </div>
                            <ol id="lightgallery-detail" class="carousel-indicators list-inline">
                                <?php $i = 1; ?>
                                @if($product->video_url !== '#')
                                    <li class="items-image-1" href="{{$product->video_url}}">
                                        <img src="{{url("/web/image/detail/eva/eva-thumb-small.jpg")}}"/>
                                    </li>
                                    <?php $i++; ?>
                                @endif
                                @foreach($product->images as $img)
                                    <li class="items-image-<?php echo $i ?>"
                                        href="{{route("productImageShow", ["id" => $product->id, "size"=>609, "fileName" => $img->name])}}"
                                        @if ($i> 5)style="display: none;" @endif>
                                        <img src="{{route("productImageShow", ["id" => $product->id,"size"=>609, "fileName" => $img->name])}}">
                                    </li>
                                    <?php $i++; ?>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="info-product-wapper">
                    <form id="add-to-cart" method="post" action="{{route("cart.addcart")}}">
                        {{csrf_field()}}
                        <div class="product-wapper">
                            <div class="head-info">
                                <h2>{{$product->name}}</h2>

                                <?php $i = 0; ?>
                                @foreach($product->variants as $variant)
                                    <div id="price_{{$variant->id}}"
                                         class="product-price @if($i == 0){{"active"}}@endif">
                                <span class="ga-product-price" data-price="{{$variant->price}}"
                                      data-sku="{{$variant->sku}}">
                                    {{price($variant->price)}}đ
                                </span>
                                        @if($variant->compare_price > $variant->price)
                                            <span class="old">
                                    {{price($variant->compare_price)}}đ
                                </span>
                                        @endif
                                    </div>
                                    <?php $i++; ?>
                                @endforeach
                                <div class="description">{!!$product->description->description!!}</div>
                            </div>
                            <div class="section-review-pr">
                                <div class="review-pr">
                                    <a href="#reviews-slide">
                                        <span>4.5</span> <img src="{{url("/web/image/star-halt.svg")}}" alt=""/>
                                        <span class="count-review">{{$reviews->count()}} đánh giá</span>
                                    </a>
                                </div>
                                <div class="count-pl">{{$product->total_sale}} Đã bán</div>
                            </div>
                            {{ Widget::run('showCountDown', ["entity_id" => $product->id, "entity_type" => "2"]) }}
                            <div class="variant-product-wapper display-flex">
                                <?php $i = 0; ?>
                                @foreach($attributeName as $keyCode => $name)
                                    <div class="variant-items {{$keyCode}}">
                                        <div class="title-variant">
                                            {{$name}}:
                                            <span class="hidden {{$keyCode}}">Vui lòng chọn {{$name}}</span>
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
                                            Số lượng
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
                            <div class="line-bottom">
                                <div class="title-block">Chứng chỉ</div>
                                <div class="certificate-block">
                                    <div class="list-certificate">
                                        <div class="item-certificate">
                                            <div class="image-certificate">
                                                <img class="lazyload" data-src="{{url("web/image/okeko-tex.jpg")}}">
                                            </div>
                                            <div class="tooltip-certificate">
                                                Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng
                                                đến sức khỏe
                                                người dùng như formaldehyde, thuốc trừ sâu, kim loại nặng chiết xuất
                                                được, các chất
                                                dẫn gốc chlor hữu cơ và các chất bảo quản như tetra – và
                                                pentachlorophenol…
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="compare-link" href="/so-sanh/{{$product->slug}}">So sánh với các loại đệm khác</a>
                            {{ Widget::run('showVoucher') }}
                            <div class="sale-products">
                                {{ Widget::run('notifySale', ["product_id" => $product->id]) }}
                                {{ Widget::run('productBundles',["entity_product_id" =>$product->id]) }}
                            </div>
                            <div class="bottom-bar">
                                <div class="items-block">
                                    <div class="hotline-mobile">
                                        <a href="tel:18002095">
                                            <img src="{{url("/mobile/image/detail/icon_phone_bottom.svg")}}"><span>Gọi ngay</span>
                                        </a>
                                    </div>
                                    <button type="button" class="add-to-cart js-ga-add-to-cart"
                                            data-product-name="{{$product->name}}"
                                            data-product-id="{{$product->id}}"
                                            data-product-price="{{$product->price}}"
                                            data-product-brand="{{$product->brand->name}}">Mua Ngay
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(!$reviews->isEmpty())
            <?php $a = 1; ?>
            <div class="line-bottom">
                <div class="title-block active">Đánh giá của khách hàng ({{$reviews->count()}}) <i
                            class="fa fa-angle-right" aria-hidden="true"></i></div>
                <div class="body-block active">
                    <div class="section-testimonial section-homepage" id="reviews-slide">
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
            </div>
        @endif
        <div class="line-bottom">
            <div class="title-block">Lý do chọn đệm <i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="body-block">
                <div class="section-image">
                    <img class="lazyload" data-src="{{url("web/image/block-top.png")}}">
                </div>
                <div class="section-background-image">
                    <div class="content-wapper">
                        <h4>3 điểm khiến đệm Goodnight Eva <br>rẻ bất ngờ</h4>
                        <ul>
                            <li>Đệm được nhập khẩu nguyên liệu, sản xuất và phân phối trực tiếp bởi Dem.vn</li>
                            <li>Đệm được bán trực tuyến tại Dem.vn, cắt giảm chi phí cho các cửa hàng phân phối</li>
                            <li>Hạn chế tối đa các loại phụ phí cho kho bãi, vận chuyển</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-feature line-bottom">
            <div class="title-block">Tính năng <i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="body-block">
                <h3>Tận hưởng giấc ngủ trọn vẹn cùng<br> Goodnight Eva</h3>
                <div class="feature-items">
                    <img class="lazyload" data-src="{{url("web/image/grid-1.jpg")}}">
                    <div class="content-items">
                        <h4>Khả năng nâng đỡ cơ thể vượt trội</h4>
                        <p>Chất liệu foam REBOND với tỉ trọng foam cao giúp nâng đỡ cơ thể vững chãi</p>
                    </div>
                </div>
                <div class="feature-items">
                    <img class="lazyload" data-src="{{url("web/image/grid-2.jpg")}}">
                    <div class="content-items">
                        <h4>Nguyên liệu sạch & an toàn</h4>
                        <p>Sử dụng nguyên liệu 100% PURE & CLEAN, đảm bảo tiêu chuẩn khắt khe của Nhật, an toàn
                            tuyệt đối cho người sử dụng</p>
                    </div>
                </div>
                <div class="feature-items">
                    <img class="lazyload" data-src="{{url("web/image/grid-3.jpg")}}">
                    <div class="content-items">
                        <h4>Vỏ bọc sang trọng mềm mại cho làn da</h4>
                        <p>2 lớp vỏ bọc: lớp cotton bên trong bảo vệ lõi đệm khỏi bụi bẩn, vỏ gấm Polyester mềm mại
                            giúp nâng niu làn da của bạn</p>
                    </div>
                </div>
                <div class="feature-items">
                    <img class="lazyload" data-src="{{url("web/image/grid-4.jpg")}}">
                    <div class="content-items">
                        <h4>Độ dày đệm lý tưởng</h4>
                        <p>Độ dày 10cm phù hợp với mọi chiếc giường, phù hợp với người lớn tuổi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="line-bottom">
            <div class="title-block">Thông số <i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="body-block">
                <div class="features-product">
                    <div class="content-wapper">
                        <div class="list-features">
                            <div class="item-features">
                                <p>Chất liệu: Foam</p>
                                <p>Độ cứng mềm: 8</p>
                            </div>
                            <div class="item-features">
                                <p>Thời gian bảo hành: 5 năm</p>
                                <p>Xuất xứ: Việt Nam</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-list-right">
                    <div class="certificate">
                        <ul>
                            <li>
                                <div class="image"><img class="lazyload" data-src="{{url("web/image/list-21.png")}}">
                                </div>
                                <div class="content">
                                    <h5>Chứng chỉ OEKO-TEX Standard 100</h5>
                                    <p>Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng đến sức
                                        khỏe
                                        người dùng như formaldehyde, thuốc trừ sâu, kim loại nặng chiết xuất được, các
                                        chất
                                        dẫn gốc chlor hữu cơ và các chất bảo quản như tetra – và pentachlorophenol…</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="line-bottom">
            <div class="title-block">Đặc điểm <i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="body-block">
                <div class="section-image-text section-01">
                    <div class="banner">
                        <img src="{{url("web/image/grid-6.jpg")}}"/>
                    </div>
                    <div class="content-block">
                        <h4>Chất lượng tiêu chuẩn, mức giá dễ chịu</h4>
                        <p>Đệm foam Goodnight Eva có độ cứng mềm vừa phải, hỗ trợ mọi tư thế nằm. Dù bạn lựa chọn tư thế
                            ngủ
                            nào, Goodnight Eva đảm bảo giúp bạn an giấc mỗi đêm. Đi kèm với chất lượng là một mức giá
                            siêu
                            rẻ, siêu hấp dẫn</p>
                        <div class="view-button">
                            <a href="#">Ngủ ngon hơn</a>
                        </div>
                    </div>
                </div>
                <div class="section-image-text section-012">
                    <div class="banner">
                        <img src="{{url("web/image/grid-7.jpg")}}"/>
                    </div>
                    <div class="content-block">
                        <h4>Thiết kế 3 tấm tiện lợi phù hợp với không gian nhỏ, dễ vận chuyển</h4>
                        <p>Đệm foam Goodnight Eva với thiết kế 3 tấm có thể gấp gọn, dễ dàng mang vác khi cần chuyển nhà
                            hoặc cất trữ làm đệm dự phòng khi người thân, bạn bè tới thăm. đệm đặc biệt phù hợp với căn
                            hộ,
                            phòng ở có không gian nhỏ hẹp</p>
                        <div class="view-button">
                            <a href="#">Ngủ ngon hơn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($product->video_url !== '#')
            <div class="section-bg-bottom">
                <div class="title-block">Video <i class="fa fa-angle-right" aria-hidden="true"></i></div>
                <div class="body-block">
                    <div class="section-video">
                        <div class="video-content">
                            <iframe width="100%" height="500" src="{{$product->video_url}}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <style>
        .hotline-phone-ring-wrap {
            display: none;
        }

        @media (max-width: 767px) {
            #main-image-product {
                min-height: 220px;
            }

            .product-detail-page #testimonialCarousel {
                height: 360px;
                position: relative;
                overflow: hidden;
            }

            .product-detail-page #testimonialCarousel.slick-slider {
                overflow: visible;
                height: auto;
            }
        }
    </style>
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
                        $(".KICH_THUOC_CM").removeClass("hidden");
                        $(".attribute-group-name").addClass("error_variant");
                        errorVariant = true;
                    }

                    if (!$(".product_variant_option li").hasClass("active")) {
                        $(".DO_DAY_CM").removeClass("hidden");
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
