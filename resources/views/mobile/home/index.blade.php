@extends('layouts.mobile-homepage')
@section('content')
{{ Widget::run('showCountDown', ["entity_type" => "1"]) }}
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
    body .section-feature-product .items-product .item .description{height: 140px;}
    .section-feature-product .items-product .item .description p{margin: 0;}
    body {    line-height: 1.5;}
    body{margin: 0!important}
.section-slider-main .slick-slide{padding: 0;}
</style>
<div class="section-services section-homepage">
    <h2 class="title-section">Vì sao bạn nên mua <br> đệm online tại Dem.vn?</h2>
    <div class="content-section container-home">
        <div class="items-section">
            <div class="item-services">
                <div class="icon"><img class="lazyload" data-src="{{url("/mobile/image/homepage/ic-gia.svg")}}"></div>
                <div class="title">Giá siêu “mềm"</div>
                <div class="desc">Mức giá phù hợp với mọi ngân sách</div>
            </div>
            <div class="item-services">
                <div class="icon"><img class="lazyload" data-src="{{url("/mobile/image/homepage/ic-freeship.svg")}}"></div>
                <div class="title">Miễn phí vận chuyển</div>
                <div class="desc">Miễn phí vận chuyển toàn quốc</div>
            </div>
            <div class="item-services">
                <div class="icon"><img class="lazyload" data-src="{{url("/mobile/image/homepage/ic-nguthu.svg")}}"></div>
                <div class="title">180 ngày ngủ thử</div>
                <div class="desc">Chương trình ngủ thử dài nhất hiện nay</div>
            </div>
            <div class="item-services">
                <div class="icon"><img class="lazyload" data-src="{{url("/mobile/image/homepage/ic-diembanuytin.svg")}}"></div>
                <div class="title">Điểm bán uy tín</div>
                <div class="desc">Đơn vị trực thuộc và vận hành bởi Vua Nệm</div>
            </div>
            <div class="item-services">
                <div class="icon"><img height="58" class="lazyload" data-src="{{url("/mobile/image/homepage/ic-doitra.png")}}"></div>
                <div class="title">Miễn phí đổi trả</div>
                <div class="desc">Chỉ 0đ để đổi một chiếc đệm vừa ý</div>
            </div>
        </div>
    </div>
</div>
<div class="section-banner background">
    <div class="content-section">
        <img class="lazyload" data-src="{{url("/mobile/image/homepage/banner2.jpg")}}">
        <div class="block-text">
              <div class="content">
            <h2>Dễ dàng tìm ra chiếc đệm phù hợp qua 180 đêm ngủ thử miễn phí</h2>
            <p>Dem.vn dành tặng bạn 180 đêm ngủ thử miễn phí -  thời gian trải nghiệm dài nhất hiện nay. Trong thời gian nằm thử, nếu bạn không cảm thấy hài lòng với chiếc đệm đã lựa chọn, bạn có thể dễ dàng đổi sang chiếc đệm khác phù hợp hơn.</p>
            <a href="#feature-product" class="button-action style1 half"><span>Chọn đệm ngay</span></a>
                </div>
        <div class="addgadient">
        </div>
        </div>
    </div>
</div>
<div class="section-feature-product" id="feature-product">
    <h2 class="title-section">Chiếc đệm nào sẽ phù hợp với bạn</h2>
    <div class="content-section container-home">
        <div class="items-product">
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
                        <div class="image-product">
                                @if($i == 0)
                                <div class="label-product">Giá tốt nhất</div>
                                @elseif ($i == 1)
                                <div class="label-product">Công nghệ Mỹ</div>
                                @elseif ($i == 2)
                                <div class="label-product">Best-seller</div>
                                @endif
                            @if(!empty($product->images->first()))
                                <img data-src="{{route("productImageShow", [
                                        "id" => $product->id,
                                        "size" => 340,
                                        "fileName" => $product->images->first()->name
                                        ])}}" alt="" width="340" height="340" class="image-product lazyload">
                            @else
                                <img data-src="{{route("productImageShow", [
                                        "id" => $product->id,
                                        "size" => 340,
                                        "fileName" => "default.jpg"
                                        ])}}" alt="" width="340" height="340" class="image-product lazyload">
                            @endif
                            @if($product->compare_price > $product->price)
                                <div class="discount-percent">-{{round((($product->compare_price - $product->price) / $product->compare_price) * 100)}}%</div>
                            @endif
                        </div>
                        <div class="description">{!! $product->description->description ?? '' !!}</div>
                        <div class="button-action style2">
                            <span>Mua ngay</span>
                        </div>
                    </a>
                </div>
                <?php $i++; ?>
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
<div class="section-banner style-2">
    <div class="content-section">
        <img class="lazyload" data-src="{{url("/mobile/image/homepage/banner2.png")}}">
        <div class="block-text">

            <h2>Chi tiêu ít hơn để ngủ ngon hơn </h2>
            <p><span>Dem.vn luôn nỗ lực tìm kiếm phương án tối ưu về giá. Chúng tôi hy vọng bạn có thể tận hưởng giấc ngủ ngon trên chiếc đệm chất lượng. Sở hữu một chiếc đệm tốt với ngân sách hợp lý chưa bao giờ dễ dàng hơn lúc này</span></p>
            <a href="#" class="button-action style1"><span>Mua ngay</span></a>

        </div>
    </div>
</div>

<div class="section-certificate">
     <span class="background-top"></span>
    <h2 class="title-section">Chứng chỉ đạt được</h2>
    <div class="desc-section">Nhằm khẳng định chất lượng giữa những sản phẩm khác trên thị trường </div>
    <div class="content-section container-home">
        <div class="items-section display-flex">
                <div class="item-certificate">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/certificate1.jpg")}}">
                    </div>
                    <div class="certificate-content">
                        <div class="title">Chứng chỉ CertiPUR-US</div>
                        <div class="desc">Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng đến sức  khỏe người dùng như formaldehyde, thuốc <br> trừ sâu, kim loại nặng chiết xuất được...</div>
                    </div>
                </div>
                <div class="item-certificate">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/certificate2.jpg")}}">
                    </div>
                     <div class="certificate-content">
                    <div class="title">Chứng chỉ Intertek TQA</div>
                    <div class="desc">Chứng nhận đảm bảo chất lượng toàn diện, chứng nhận sản phẩm phù hợp với tiêu chuẩn ISO 9001:2015</div>
                </div>
                </div>
                <div class="item-certificate">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/certificate3.jpg")}}">
                    </div>
                     <div class="certificate-content">
                    <div class="title">Chứng chỉ BSCI</div>
                    <div class="desc">Chứng nhận tổ chức đạt tiêu chuẩn về trách nhiệm xã hội BSCI – BUSINESS SOCIAL COMPLIANCE INITIATIVE do tổ chức INTERTEK xác nhận</div>
                </div>
                </div>

                <div class="item-certificate">
                    <div class="icon">
                        <img class="lazyload" data-src="{{url("/web/image/homepage/certificate4.jpg")}}">
                    </div>
                     <div class="certificate-content">
                    <div class="title">Chứng chỉ OEKO-TEX Standard 100</div>
                    <div class="desc">Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng đến sức khỏe người dùng như formaldehyde, thuốc trừ sâu, kim loại nặng ...</div>
                </div>
                </div>
            </div>
    </div>
</div>
<div class="section-blog section-homepage">
    <div class="container-home">
        <div class="col-left">
            <div class="head-section">
                <div class="title">
                    <h2>Chuyện giấc ngủ</h2>
                    <p>Khám phá ngay blog Dem.vn</p>
                </div>
                <img class="icon-blog lazyload" data-src="{{url("/mobile/image/homepage/icon-blog.png")}}">
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
