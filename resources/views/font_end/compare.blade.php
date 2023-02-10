@extends('layouts.master')
@section('content')
    <div id="compare-pages">
        <div class="top-bar" style="display: none">
            <div class="container">
                <div class="row">
                    <div class="title-1"><a href="/products/{{$products[$currentProductId]['slug']}}.html">{{$products[$currentProductId]['name']}}</a></div>
                    <div class="title-2"><a href="#">Đệm bông ép gấp 3 tấm khác</a></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="head-block">
                <div class="title-block">Điều gì khiến chúng <br> tôi được tin tưởng?</div>
                <div class="content-block">
                    <div class="certificate">
                        <div class="item-certificate">
                            <img class="lazyload" data-src="{{url("/web/image/compare/certipur-us.jpg")}}">
                            <span class="tooltiptext">Đây là chứng chỉ chuyên ngành mút, do Alliance for Flexible Polyurethane Foam, Inc. của Mỹ tiến hành đánh giá và kiểm tra nhằm mục đích xác nhận mút thân thiện với môi trường</span>
                        </div>
                        <div class="item-certificate">
                            <img class="lazyload" data-src="{{url("/web/image/compare/intertek.jpg")}}">
                            <span class="tooltiptext">chứng nhận đảm bảo chất lượng toàn diện, chứng nhận sản phẩm phù hợp với tiêu chuẩn ISO 9001:2015</span>
                        </div>
                        <div class="item-certificate">
                            <img class="lazyload" data-src="{{url("/web/image/compare/amfori-bsci.jpg")}}">
                            <span class="tooltiptext">Chứng nhận tổ chức đạt tiêu chuẩn về trách nhiệm xã hội BSCI – BUSINESS SOCIAL COMPLIANCE INITIATIVE do tổ chức INTERTEK xác nhận</span>
                        </div>
                        <div class="item-certificate">
                            <img class="lazyload" data-src="{{url("/web/image/compare/okeko-tex.jpg")}}">
                            <span class="tooltiptext">Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng đến sức khỏe người dùng như formaldehyde, thuốc trừ sâu, kim loại nặng chiết xuất được, các chất dẫn gốc chlor hữu cơ và các chất bảo quản như tetra – và pentachlorophenol…</span>
                        </div>
                    </div>
                    <div class="desc-block">Các chứng chỉ về chất lượng sản phẩm</div>
                </div>
            </div>
            <div class="main-block">
                <div class="title-block">So sánh các đệm của dem.vn</div>
                <div class="content-block">
                    <div class="choose-product">
                        <div class="items-selects">
                            <div class="title">Chọn đệm muốn mua</div>
                            <div class="product-choose" id="product-buy">
                                <div class="title-select">
                                    <span>{{$products[$currentProductId]['name']}}</span> <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </div>
                                <ul>
                                    @foreach($products as $item) 
                                        <li class="@if($currentProductId == $item['id']){{"active"}}@endif" data-key="{{$item['id']}}">{{$item['name']}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="items-selects">
                            <div class="title">Chọn đệm muốn so sánh</div>
                            <div class="product-choose" id="product-compare">
                                <div class="title-select"><span>Đệm bông ép gấp 3 tấm khác</span> <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                <ul>
                                    <li class="active" data-key="bong_ep">Đệm bông ép 3 tấm khác</li>
                                    @foreach($products as $item) 
                                        <li class="@if($currentProductId == $item['id']){{"disabled"}}@endif" data-key="{{$item['id']}}">{{$item['name']}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="feature-product">
                        <div class="columns-features">
                            <div class="item-feature image-product">
                                <div class="label-feature"></div>
                                <div class="content-feature">
                                    <div class="value_1">
                                        <div class="value name">
                                            {{$products[$currentProductId]['name']}}
                                        </div>
                                        <?php
                                            $urlImage = '';
                                            if (strpos($products[$currentProductId]['name'], 'Eva') == true) {
                                                $urlImage = url("/web/image/compare/eva.png");
                                            } else if (strpos($products[$currentProductId]['name'], 'Galaxy') == true) {
                                                $urlImage = url("/web/image/compare/galaxy.png");
                                            } else if (strpos($products[$currentProductId]['name'], '4Stars') == true) {
                                                $urlImage = url("/web/image/compare/4stars.png");
                                            }
                                        ?>
                                        
                                        <img class="image-product" src="<?php echo $urlImage ?>">
                                    </div>
                                    <div class="value_2">
                                        <div class="value name">
                                            Đệm bông ép 3 tấm khác
                                        </div>
                                        <img class="image-product" src="{{url("/web/image/compare/bong-ep.png")}}">
                                    </div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Chất liệu</div>
                                <div class="content-feature">
                                    <div class="value_1"><div class="value material">Chất liệu FOAM REBOND với tỉ trọng foam cao</div></div>
                                    <div class="value_2"><div class="value material">Sợi Polyester (Bông xơ)</div></div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Vỏ bọc</div>
                                <div class="content-feature">
                                    <div class="value_1">
                                        <div class="value skin">Vỏ bọc 2 lớp: Lớp bảo vệ cotton, vỏ gấm polyester</div>
                                    </div>
                                    <div class="value_2"><div class="value skin">Vỏ 1 lớp cotton</div></div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Thiết kế</div>
                                <div class="content-feature">
                                    <div class="value_1">
                                        <div class="value design">Thiết kế 3 tấm</div>
                                    </div>
                                    <div class="value_2"><div class="value design">Thiết kế 3 tấm</div></div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Kích thước</div>
                                <div class="content-feature">
                                    <div class="value_1"><div class="value size">
                                        <ul class="variant">
                                            <li>120 x 200cm</li>
                                            <li>140 x 200cm</li>
                                            <li>160 x 200cm</li>
                                            <li>180 x 200cm</li>
                                            <li>220 x 200cm</li>
                                            <li class="spec">Đặc biệt: Kích thước tuỳ chọn</li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="value_2"><div class="value size">
                                        <ul class="variant">
                                            <li>160 x 200cm</li>
                                            <li>180 x 200cm</li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Độ dày</div>
                                <div class="content-feature">
                                    <div class="value_1"><div class="value thickness">Độ dày: 10cm</div></div>
                                    <div class="value_2"><div class="value thickness">Độ dày: Tuỳ theo nhà sản xuất</div></div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Độ cứng mềm</div>
                                <div class="content-feature">
                                    <div class="value_1"><div class="value soft_hardness">8/10 (độ cứng mềm vừa phải)</div></div>
                                    <div class="value_2"><div class="value soft_hardness">10/10 (siêu cứng)</div></div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Chứng chỉ</div>
                                <div class="content-feature">
                                    <div class="value_1">
                                        <div class="value certificate">
                                            <div class="images">
                                                <div class="item-certificate">
                                                    <img src="{{url("/web/image/compare/okeko-tex.jpg")}}">
                                                </div>
                                            </div>
                                            <p class="label">Chứng chỉ OKEKO-TEX Standard 100</p>
                                        </div>
                                    </div>
                                    <div class="value_2">
                                        <div class="value certificate">
                                            <div class="images">
                                            </div>
                                            <p class="label">Chứng chỉ: Không</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Đối tượng phù hợp</div>
                                <div class="content-feature">
                                    <div class="value_1"><div class="value suitable_audience">Tất cả mọi người. Đặc biệt người cao tuổi, người gặp vấn đề về xương khớp</div></div>
                                    <div class="value_2"><div class="value suitable_audience">Những người quen nằm bề mặt cứng</div></div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Chương trình ngủ thử</div>
                                <div class="content-feature">
                                    <div class="value_1">
                                        <div class="value sleep_test">
                                            <a href="#">6 tháng đổi trả miễn phí</a>
                                            <p>Chỉ có tại dem.vn</p>
                                        </div>
                                    </div>
                                    <div class="value_2"><div class="value sleep_test">Chương trình ngủ thử: Không</div></div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Thời gian bảo hành</div>
                                <div class="content-feature">
                                    <div class="value_1">
                                        <div class="value warranty">
                                            <a href="#">Bảo hành 5 năm</a>
                                            <p>Chỉ có tại dem.vn</p>
                                        </div>
                                    </div>
                                    <div class="value_2"><div class="value warranty">Thời gian bảo hành không cao (khoảng 1 năm)</div></div>
                                </div>
                            </div>
                            <div class="item-feature">
                                <div class="label-feature">Vận chuyển</div>
                                <div class="content-feature">
                                    <div class="value_1">
                                        <div class="value shipping">
                                            <a href="#">Miễn phí vận chuyển</a>
                                            <p>Chỉ có tại dem.vn</p>
                                        </div>
                                    </div>
                                    <div class="value_2"><div class="value shipping">Tính phí theo quãng đường vận chuyển</div></div>
                                </div>
                            </div>
                            <div class="action">
                                <a href="{{$products[$currentProductId]['slug']}}.html" class="button-action style1 col-1"><span>{{$products[$currentProductId]['name']}}</span></a>
                                <a href="#" class="button-action style1 col-2" style="display: none"><span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $a = 1; ?>
        <div class="section-testimonial section-homepage"> 
            <h3 class="title-section">Khách hàng nói gì về chúng tôi</h3>
            <div class="text-center star-rating">
                <img src="/web/image/homepage/star.svg"/>
            </div>
            <div class="content-section">
                <div id="testimonialCarousel-{{$item['id']}}" class="review-section testimonialCarousel-{{$item['id']}} @if($currentProductId == $item['id']){{"active"}}@endif">
                    @foreach($reviews as $review)
                        <div class="review-items">
                            <div class="feedback-customer">
                                <div class="customer-name">{{ $review->getUser->name }}</div>
                                <p>{{$review->content}}</p>
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
    </div>
    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#lightgallery-review').lightGallery();

            $(".section-testimonial .image-review").click(function() {
                var position = $(this).data("index");
                $("#lightgallery-review .items-image-" + position).click();
            });
        });
        window.onload = function() {
            initFeatureProducts(<?php echo $currentProductId ?>, 1)
        };
        function initFeatureProducts(productname, value) {
            var feature = {
                '1': {
                    "name" : "Đệm Foam Gấp 3 Goodnight Eva",
                    "image" : "eva.png",
                    "url": "dem_foam_gap_3_goodnight_eva",
                    "material" : "Chất liệu FOAM REBOND với tỉ trọng foam cao",
                    "skin" : "Vỏ bọc 2 lớp: Lớp bảo vệ cotton, vỏ gấm polyester",
                    "design" : "Thiết kế 3 tấm",
                    "size" : {
                        "value": {
                            0: "120 x 200cm",
                            1: "140 x 200cm",
                            2: "160 x 200cm",
                            3: "180 x 200cm",
                            4: "220 x 200cm",
                        },
                        "spec": "Đặc biệt: Kích thước tuỳ chọn",
                    },
                    "thickness" : "Độ dày: 10cm",
                    "soft_hardness" : "8/10 (độ cứng mềm vừa phải)",
                    "certificate" : {
                        0: {
                            "image": 'okeko-tex.jpg',
                            "title": "Chứng Chỉ OEKO-TEX Standard 100"
                        },
                    },
                    "suitable_audience" : "Tất cả mọi người. Đặc biệt người cao tuổi, người gặp vấn đề về xương khớp",
                    "sleep_test" : {
                        'title': "6 tháng đổi trả miễn phí",
                        'url': "https://dem.vn/blog/chuong-trinh-ngu-thu-180-dem/",
                        'description': "Chỉ có tại dem.vn",
                    },
                    "warranty" : {
                        'title': "Bảo hành 5 năm",
                        'url': "https://dem.vn/blog/chinh-sach-bao-hanh/",
                        'description': "Chỉ có tại dem.vn",
                    },
                    "shipping" : {
                        'title': "Miễn phí vận chuyển",
                        'url': "https://dem.vn/blog/chinh-sach-van-chuyen-giao-nhan/",
                        'description': "Chỉ có tại dem.vn",
                    },
                },
                '3': {
                    "name" : "Đệm Foam Goodnight Galaxy",
                    "image" : "galaxy.png",
                    "url": "dem_foam_goodnight_galaxy",
                    "material" : "Lõi foam trà xanh hoạt tính. Foam tỷ trọng cao với tinh chất trà xanh",
                    "skin" : "Vải thun cao cấp thoáng khí",
                    "design" : "Thiết kế 1 tấm",
                    "size" : {
                        "value": {
                            0: "120 x 200cm",
                            1: "160 x 200cm",
                            2: "180 x 200cm",
                            3: "220 x 200cm",
                        },
                        "spec": "Đặc biệt: Kích thước tuỳ chọn",
                    },
                    "thickness" : "Độ dày: 12cm",
                    "soft_hardness" : "7/10 (Độ cứng mềm vừa phải)",
                    "certificate" : {
                        0: {
                            "image": 'okeko-tex.jpg',
                            "title": "Chứng Chỉ OEKO-TEX Standard 100"
                        },
                    },
                    "suitable_audience" : "Tất cả mọi người. Đặc biệt phụ nữ mang thai, người có thói quen nằm nghiêng.",
                    "sleep_test" : {
                        'title': "6 tháng đổi trả miễn phí",
                        'url': "https://dem.vn/blog/chuong-trinh-ngu-thu-180-dem/",
                        'description': "Chỉ có tại dem.vn",
                    },
                    "warranty" : {
                        'title': "Bảo hành 5 năm",
                        'url': "https://dem.vn/blog/chinh-sach-bao-hanh/",
                        'description': "Chỉ có tại dem.vn",
                    },
                    "shipping" : {
                        'title': "Miễn phí vận chuyển",
                        'url': "https://dem.vn/blog/chinh-sach-van-chuyen-giao-nhan/",
                        'description': "Chỉ có tại dem.vn",
                    },
                },
                '2': {
                    "name" : "Đệm Lò xo Goodnight 4Stars",
                    "image" : "4stars.png",
                    "url": "dem_lo_xo_goodnight_4stars",
                    "material" : "Khung lò xo Bonnell",
                    "skin" : "Vải Tricot định lượng 80gsm",
                    "design" : "Thiết kế 1 tấm (có thể cuộn hút chân không)",
                    "size" : {
                        'value': {
                            0: "120 x 200cm",
                            1: "160 x 200cm",
                            2: "180 x 200cm",
                            3: "220 x 200cm"
                        },
                        "spec": "Đặc biệt: Kích thước tuỳ chọn"
                    },
                    "thickness" : "Độ dày: 20cm",
                    "soft_hardness" : "8/10 (độ cứng mềm vừa phải)",
                    "certificate" : {
                        0: {
                            "image": 'certipur-us.jpg',
                            "title": "Chứng chỉ CertiPUR-US"
                        },
                        2: {
                            "image": 'intertek.jpg',
                            "title": "Intertek"
                        },
                        3: {
                            "image": 'amfori-bsci.jpg',
                            "title": "Amfori-BSCI"
                        },
                    },
                    "suitable_audience" : "Tất cả mọi người. Phù hợp với người có yêu cầu cao về chất lượng giấc ngủ",
                    "sleep_test" : {
                        'title': "6 tháng đổi trả miễn phí",
                        'url': "https://dem.vn/blog/chuong-trinh-ngu-thu-180-dem/",
                        'description': "Chỉ có tại dem.vn",
                    },
                    "warranty" : {
                        'title': "Bảo hành 5 năm",
                        'url': "https://dem.vn/blog/chinh-sach-bao-hanh/",
                        'description': "Chỉ có tại dem.vn",
                    },
                    "shipping" : {
                        'title': "Miễn phí vận chuyển",
                        'url': "https://dem.vn/blog/chinh-sach-van-chuyen-giao-nhan/",
                        'description': "Chỉ có tại dem.vn",
                    },
                },
                '7': {
                        "name": "Đệm Foam Goodnight Massage Nhật Bản",
                        "image": "massage.png",
                        "url": "dem_foam_goodnight_massage_nhat_ban",
                        "material": "PU foam với cấu trúc bề mặt lượn sóng",
                        "skin": "Vải thun mềm kết hợp vải lưới 3D",
                        "design": "Thiết kế 1 tấm (có thể cuộn hút chân không)",
                        "size": {
                            'value': {
                                0: "120 x 200cm",
                                1: "160 x 200cm",
                                2: "180 x 200cm",
                                3: "220 x 200cm"
                            },
                            "spec": "Đặc biệt: Kích thước tuỳ chọn"
                        },
                        "thickness": "Độ dày: 9cm",
                        "soft_hardness": "7/10 (độ cứng mềm vừa phải)",
                        "certificate": {
                            0: {
                                "image": 'okeko-tex.jpg',
                                "title": "Chứng chỉ OEKO-TEX Standard 100"
                            },
                            2: {
                                "image": 'ISO.jpg',
                                "title": "ISO 45001:2018"
                            },        
                        },
                        "suitable_audience": "Tất cả mọi người. Phù hợp với người có yêu cầu cao về chất lượng giấc ngủ",
                        "sleep_test": {
                            'title': "6 tháng đổi trả miễn phí",
                            'url': "https://dem.vn/blog/chuong-trinh-ngu-thu-180-dem/",
                            'description': "Chỉ có tại dem.vn",
                        },
                        "warranty": {
                            'title': "Bảo hành 5 năm",
                            'url': "https://dem.vn/blog/chinh-sach-bao-hanh/",
                            'description': "Chỉ có tại dem.vn",
                        },
                        "shipping": {
                            'title': "Miễn phí vận chuyển",
                            'url': "https://dem.vn/blog/chinh-sach-van-chuyen-giao-nhan/",
                            'description': "Chỉ có tại dem.vn",
                        },
                    },
                'bong_ep': {
                    "name" : "Đệm bông ép 3 tấm khác",
                    "image" : "bong-ep.png",
                    "material" : "Sợi Polyester (Bông xơ)",
                    "skin" : "Vỏ 1 lớp cotton",
                    "design" : "Thiết kế 3 tấm",
                    "size" : {
                        "value": {
                            0: "160 x 200cm",
                            1: "180 x 200cm",
                        }
                    },
                    "thickness" : "Độ dày: Tuỳ theo nhà sản xuất",
                    "soft_hardness" : "10/10 (siêu cứng)",
                    "certificate" : {
                        0: {
                            "image": '',
                            "title": "Chứng chỉ: Không"
                        },
                    },
                    "suitable_audience" : "Những người quen nằm bề mặt cứng",
                    "sleep_test" : {
                        'title': "Chương trình ngủ thử: Không",
                        'url': "",
                        'description': "",
                    },
                    "warranty" : {
                        'title': "Thời gian bảo hành không cao (khoảng 1 năm)",
                        'url': "",
                        'description': "",
                    },
                    "shipping" : {
                        'title': "Tính phí theo quãng đường vận chuyển",
                        'url': "",
                        'description': "",
                    }
                }
            }
            var urlImage = "/web/image/compare/";
            if (value === 1) {
                $(".action .col-1 span").text(feature[productname]['name']);
                $(".action .col-1").attr("href", "/products/" + feature[productname]['url'] + ".html");
                $(".top-bar .title-1 a").text(feature[productname]['name']).attr("href", "/products/" + feature[productname]['url'] + ".html");
                var obj = { Title: 'So sánh', Url: feature[productname]['url'] };
                history.pushState(obj, obj.Title, obj.Url);
            } else if (value === 2) {
                if (productname != "bong_ep") {
                    $(".action .col-2 span").text(feature[productname]['name']);
                    $(".action .col-2").show().attr("href", "/products/" + feature[productname]['url'] + ".html");
                    $(".top-bar .title-2 a").text(feature[productname]['name']).attr("href", "/products/" + feature[productname]['url'] + ".html");
                } else {
                    $(".action .col-2").hide();
                    $(".top-bar .title-2 a").text(feature[productname]['name']).attr("href", "#");
                }
            }
            $(".value_" + value +" .name").text(feature[productname]['name']);
            $(".value_" + value +" .image-product").attr("src", urlImage + feature[productname]['image']);
            $(".value_" + value +" .material").text(feature[productname]['material']);
            $(".value_" + value +" .skin").text(feature[productname]['skin']);
            $(".value_" + value +" .design").text(feature[productname]['design']);
        
            $(".value_" + value +" .size .variant").html("");
            Object.keys(feature[productname]['size']['value']).forEach(function (item) {
                $(".value_" + value +" .size .variant").append("<li>"+ feature[productname]['size']['value'][item] +"</li>");
            })
            if (feature[productname]['size']['spec']) {
                $(".value_" + value +" .size .variant").append("<li class='spec'>"+ feature[productname]['size']['spec'] +"</li>");
            }
        
            $(".value_" + value +" .thickness").text(feature[productname]['thickness']);
            $(".value_" + value +" .soft_hardness").text(feature[productname]['soft_hardness']);
        
            $(".value_" + value +" .certificate .images, .value_" + value +" .certificate .label").html("");
            Object.keys(feature[productname]['certificate']).forEach(function (item) {
                if (feature[productname]['certificate'][item]['image'] !== "") {
                    $(".value_" + value + " .certificate .images").append("<div class='item-certificate'><img src='"+ urlImage + feature[productname]['certificate'][item]['image'] +"'></div>");
                }
                $(".value_" + value + " .certificate .label").append("<span>" + feature[productname]['certificate'][item]['title'] + "</span>");
            })
        
            $(".value_" + value +" .suitable_audience").text(feature[productname]['suitable_audience']);
        
            if (feature[productname]['sleep_test']['url'] !== "") {
                $(".value_" + value +" .sleep_test").html("<a href='" + feature[productname]["sleep_test"]["url"] + "'>" + feature[productname]['sleep_test']['title'] + "</a><p>"+feature[productname]["sleep_test"]["description"]+"</p>");
            } else {
                $(".value_" + value +" .sleep_test").html(feature[productname]["sleep_test"]['title']+"<p>"+feature[productname]["sleep_test"]["description"]+"</p>");
            }
            if (feature[productname]['warranty']['url'] !== "") {
                $(".value_" + value +" .warranty").html("<a href='" + feature[productname]["warranty"]["url"] + "'>" + feature[productname]['warranty']['title'] + "</a><p>"+feature[productname]["warranty"]["description"]+"</p>");
            } else {
                $(".value_" + value +" .warranty").html(feature[productname]['warranty']['title']+"<p>"+feature[productname]["warranty"]["description"]+"</p>");
            }
            if (feature[productname]['shipping']['url'] !== "") {
                $(".value_" + value +" .shipping").html("<a href='" + feature[productname]["shipping"]["url"] + "'>" + feature[productname]['shipping']['title'] + "</a><p>"+feature[productname]["shipping"]["description"]+"</p>");
            } else {
                $(".value_" + value +" .shipping").html(feature[productname]['shipping']['title'] + "<p>"+feature[productname]["shipping"]["description"]+"</p>");
            }
        }
    </script>
    @endpush
@endsection