@extends('layouts.master-homepage')
@section('content')
    @if(isset($banners[0]))
    <div id="mainCarousel" class="section-slider-main carousel slide section-homepage" data-ride="carousel">
        <?php $i = 1; ?>
        @foreach($banners as $key => $banner)
            <div class="carousel-item @if($i == 1){{"active"}}@endif" data-index="{{$key}}">
                <a href="{{$banner->url}}">
                    @if($i > 1)
                        <img class="lazyload" alt="{{$banner->title}}"
                             data-src="{{route("showImageBanner", ["fileName" => $banner->name])}}">
                    @else
                        <img alt="{{$banner->title}}"
                             src="{{route("showImageBanner", ["fileName" => $banner->name])}}">
                    @endif
                </a>
            </div>
            <?php $i++; ?>
        @endforeach
    </div>
    <style type="text/css">
        body{margin: 0!important}
        .section-slider-main .slick-slide{padding: 0;}
    </style>
    @endif
    <div class="section-services section-homepage">
        <h2 class="title-section">Vì sao bạn nên mua đệm online tại Dem.vn?</h2>
        <div class="content-section container-home">
            <div class="items-section display-flex">
                <a class="item-services" href="/products/dem_foam_gap_3_goodnight_eva.html">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/ic-gia.svg")}}">
                    </div>
                    <div class="title">Giá siêu "mềm"</div>
                    <div class="desc">Mức giá phù hợp với mọi ngân sách</div>
                </a>
                <a class="item-services" href="/chinh-sach#cs4">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/ic-freeship.svg")}}">
                    </div>
                    <div class="title">Miễn phí vận chuyển</div>
                    <div class="desc">Miễn phí vận chuyển toàn quốc</div>
                </a>
                <a class="item-services" href="/chinh-sach#cs1">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/ic-nguthu.svg")}}">
                    </div>
                    <div class="title">180 ngày ngủ thử</div>
                    <div class="desc">Chương trình ngủ thử dài nhất hiện nay</div>
                </a>
                <a class="item-services" href="/chinh-sach#cs2">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/ic-diembanuytin.svg")}}">
                    </div>
                    <div class="title">Điểm bán uy tín</div>
                    <div class="desc">Đơn vị trực thuộc và  vận hành bởi Vua Nệm</div>
                </a>
                <a class="item-services" href="/chinh-sach#cs5">
                    <div class="icon">
                        <img height="70" class="lazyload" data-src="{{url("/web/image/homepage/ic-doitra.png")}}">
                    </div>
                    <div class="title">Miễn phí đổi trả</div>
                    <div class="desc">Chỉ 0đ để đổi một chiếc đệm vừa ý</div>
                </a>
            </div>
        </div>
    </div>
    <div class="section-banner section-homepage">
        <div class="container-home2">
            <div class="background">
                <div class="content-section">
                    <h2 class="title">
                        Dễ dàng tìm ra chiếc đệm phù hợp qua 180 đêm ngủ thử miễn phí
                    </h2>
                    <p>
                        Dem.vn dành tặng bạn 180 đêm ngủ thử miễn phí -  thời gian trải nghiệm dài nhất hiện nay. Trong thời gian nằm thử, nếu bạn không cảm thấy hài lòng với chiếc đệm đã lựa chọn, bạn có thể dễ dàng đổi sang chiếc đệm khác phù hợp hơn
                    </p>
                    <a href="#feature-product" class="button-action style1">
                        <span>Chọn đệm ngay</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="section-feature-product section-homepage" id="feature-product">
        <h2 class="title-section">
        Lựa chọn ngay chiếc đệm phù hợp với bạn
        </h2>
        <div class="content-section container-home">
            <div class="items-product display-flex">
                <?php $i = 0; ?>
                @foreach($products as $product)
                    <div class="item">
                        <a href="{{route("product.detail", ["slug" => $product->slug])}}"
                            data-product-id="{{$product->id}}"
                            data-product-name="{{$product->name}}"
                            data-product-price="{{$product->price}}"
                            data-url="{{route("product.detail", ["slug" => $product->slug])}}"
                            class="js-gaee-product-data">
                            <div class="title-product">{{limit_text($product->name, 6)}}</div>
                            <div class="price">
                                <span class="regular-price">{{price($product->price)}} đ</span>
                                @if($product->compare_price > $product->price)
                                    <span class="old-price">{{price($product->compare_price)}} đ</span>
                                @endif
                            </div>
                            <div class="description">{!! $product->description->description ?? ''!!}</div>
                            <div class="image-product">
                                @if($i == 0)
                                <div class="label-product">Giá tốt nhất</div>
                                @elseif ($i == 1)
                                <div class="label-product">Công nghệ Mỹ</div>
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
                                        ])}}" alt=""class="image-product lazyload">
                                @endif
                                @if($product->compare_price > $product->price)
                                    <div class="discount-percent">-{{round((($product->compare_price - $product->price) / $product->compare_price) * 100)}}%</div>
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
    <?php $a = 1; ?>
    <div class="section-testimonial section-homepage">
        <h2 class="title-section">Khách hàng nói gì về chúng tôi</h2>
        <div class="text-center star-rating">
            <img src="/web/image/homepage/star.svg"/>
        </div>
        <div class="content-section">
            <div id="testimonialCarousel" class="review-section" >
                @foreach($reviews as $review)
                <div class="review-items">
                    <div class="feedback-customer">
                        <div class="customer-name">{{ $review->getUser->name }}</div>
                        <p>"{{$review->content}} "</p>
                    </div>
                    <div class="col-right">
                    @isset($review->reviewImage)
                    <div class="image image-review" data-index="{{$a}}" style="background: url('{{url("image/reviews/" .$review->id ."/" . $review->reviewImage->file_name)}}')"></div>
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
                <li data-sub-html="{{ $review->getUser->name }}</h4><p>{{$review->content}}</p>" class="items-image-<?php echo $i ?>" href="{{url("image/reviews/" .$review->id ."/" . $review->reviewImage->file_name)}}">
                    <img src="{{url("image/reviews/" .$review->id ."/" . $review->reviewImage->file_name)}}">
                </li>
            @endisset
            <?php $i++; ?>
        @endforeach
    </ol>
    <div class="section-banner-style2 section-homepage">
        <div class="content-section container-home2">
            <video loop="true" autoplay="autoplay" muted>
                <source src="{{url("/web/image/homepage/new-stop-motion.mp4")}}" type="video/mp4">
                <source src="{{url("/web/image/homepage/new-stop-motion.mp4")}}" type="video/ogg">
                Your browser does not support HTML video.
            </video>

            <div class="block-text">
                <h2>Chi tiêu ít hơn để ngủ ngon hơn </h2>
                <p>Dem.vn luôn nỗ lực tìm kiếm phương án tối ưu về giá. Chúng tôi hy <br> vọng bạn có thể tận hưởng giấc ngủ ngon trên chiếc đệm chất lượng. <br> Sở hữu một chiếc đệm tốt với ngân sách hợp lý chưa bao giờ dễ dàng <br> hơn lúc này</p>
                <a href="#feature-product" class="button-action style1"><span>Mua ngay</span></a>
            </div>
        </div>
    </div>
    <div class="section-certificate section-homepage">
        <h2 class="title-section">Ngủ ngon dễ dàng hơn với chiếc đệm đạt tiêu chuẩn quốc tế</h2>
        <div class="desc-section">Các sản phẩm của Dem.vn đều đạt các chứng chỉ uy tín về chất lượng</div>
        <div class="content-section container-home">
            <div class="items-section display-flex">
                <div class="item-certificate">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/certificate1.jpg")}}">
                    </div>
                    <div class="title">Chứng chỉ CertiPUR-US</div>
                    <div class="desc">Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng đến sức  khỏe người dùng như formaldehyde, thuốc <br> trừ sâu, kim loại nặng chiết xuất được...</div>
                </div>
                <div class="item-certificate">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/certificate2.jpg")}}">
                    </div>
                    <div class="title">Chứng chỉ Intertek TQA</div>
                    <div class="desc">Chứng nhận đảm bảo chất lượng toàn diện, chứng nhận sản phẩm phù hợp với tiêu chuẩn ISO 9001:2015</div>
                </div>
                <div class="item-certificate">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/certificate3.jpg")}}">
                    </div>
                    <div class="title">Chứng chỉ BSCI</div>
                    <div class="desc">Chứng nhận tổ chức đạt tiêu chuẩn về trách nhiệm xã hội BSCI – BUSINESS SOCIAL COMPLIANCE INITIATIVE do tổ chức INTERTEK xác nhận</div>
                </div>

                <div class="item-certificate">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/certificate4.jpg")}}">
                    </div>
                    <div class="title">Chứng chỉ OEKO-TEX Standard 100</div>
                    <div class="desc">Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng đến sức khỏe người dùng như formaldehyde, thuốc trừ sâu, kim loại nặng ...</div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-blog section-homepage">
        <div class="container-home">
            <div class="display-flex">
                <div class="col-left">
                    <div class="head-section">
                        <div class="title">
                            <h2>Chuyện giấc ngủ</h2>
                            <p>Khám phá ngay blog Dem.vn</p>
                        </div>
                        <img class="icon-blog lazyload" data-src="{{url("/web/image/homepage/icon-blog.png")}}">
                    </div>
                    @if($news->count())
                        <div class="items-blog">
                            <div class="item">
                                <img class="icon-blog lazyload" data-src="{{route("showImage", [
                                "entity" => "page_news",
                                "id" => $news->first()->id,
                                "size" => 540,
                                "fileName" => $news->first()->name
                            ])}}">
                                <div class="info-blog">
                                    <a target="_blank" href="{{$news->first()->url}}" class="title-blog">
                                        {{$news->first()->title}}
                                    </a>
                                    <p class="short-desc">
                                        {{$news->first()->comment}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-right">
                    <div class="items-blog">
                        <?php $i = 0; ?>
                        @foreach($news as $new)
                            @if($i > 0)
                                <div class="item">
                                    <img class="icon-blog lazyload" data-src="{{route("showImage", [
                                        "entity" => "page_news",
                                        "id" => $new->id,
                                        "size" => 255,
                                        "fileName" => $new->name
                                    ])}}">
                                    <div class="info-blog">
                                        <a target="_blank" href="{{$new->url}}" class="title-blog">
                                            {{$new->title}}
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .header-wapper .header-menu ul.menu-list li.has-submenu > .menu-link{display: flex;align-items: center;}
        .header-wapper .header-menu ul.menu-list li.has-submenu .menu-link i{
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #6800BE;
            margin-left: 5px;
        }

    </style>
    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $(".section-testimonial .image-review").click(function() {
                var position = $(this).data("index");
                $("#lightgallery-review .items-image-" + position).click();
            });
        });
    </script>
    @endpush
@endsection
