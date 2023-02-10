@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="{{url("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("css/footer.css")}}">
    <link rel="stylesheet" href="{{url("css/style.css")}}">
    <link rel="stylesheet" href="{{url("css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{url("css/font-style.css")}}">
    <link rel="stylesheet" href="{{url("css/slick-theme.css")}}">
@endpush
@section('content')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous"/>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmXap49QqObfM9cOegCoEdUl7UUkcyEI4&callback=initMap&libraries=&v=weekly"
            defer></script>
    <style type="text/css">
        #map {
            height: 100%;
        }
    </style>

    <div class="container" style="margin-bottom: 30px;padding-top: 50px;">
        <div class="row">
            <div class="col-md-5 search-wrapper">
                <div class="store-search">
                    <p>Tìm điểm trải nghiệm</p>
                    <div class="select-search">
                        <form action="">
                          
                                        <div>
                                            <p class="title-map">Chọn tỉnh thành</p>
                                        </div>
                                        <select class="select-box select-city" name="province_id">
                                            <option value="0">Thành phố / Tỉnh</option>
                                            @if( isset($provinces) )
                                                @foreach( $provinces  as $key => $value)
                                                    @if($key == 129)
                                                        <option value="{{ $key}}">{{ $value }}</option>
                                                        <?php unset($provinces[$key]) ?>
                                                    @endif
                                                    @if($key == 130)
                                                        <option value="{{ $key}}">{{ $value }}</option>
                                                        <?php unset($provinces[$key]) ?>
                                                    @endif
                                                @endforeach
                                                @foreach( $provinces  as $key => $value)
                                                    <option value="{{ $key}}">{{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div>
                                            <p class="title-map">Chọn quận/huyện</p>
                                        </div>
                                        <select class="select-box select-district">
                                            <option value="0">Quận / Huyện</option>
                                        </select>
                             
                        </form>
                    </div>
        </div>
            </div>
            <div class="col-md-6 google-map-wrapper">
               <div>
                        <div class="search-result-header">
                            <p class="result-count">
                                <span class="count-result">
                                    <span>{{ count($retailerAddress)}}</span>
                                </span> kết quả
                                <span style="cursor: pointer" id="storeDistant"
                                      class="pull-right">Xem cửa hàng gần bạn</span>
                            </p>
                            <ul class="listing-store-result">
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($retailerAddress as  $retailer)
                                    <li class="result-item">
                                        <div class="heading" style="display: flex">
                                            <p class="name-label" style="flex: 1"><span>{{$i++}}</span>. Vua Nệm<strong>
                                                    {{$retailer->address}}</strong></p>
                                        </div>
                                        <div class="details">
                                            <p class="address" style="flex:1">
                                                <span>
                                                    {{$retailer->address}}, {{$retailer->districts->name}}, {{$retailer->province->name}}
                                                    <br>
                                                    <span>Điện thoại :</span>
                                                    {{$retailer->phone_store}}
                                                    <br>
                                                    <span>Giờ mở cửa:</span>
                                                    <span>{{ $retailer->opening_time}}</span>
                                                </span>
                                            </p>

{{--                                            <a href="https://www.google.com/maps/@.{{$retailer->latitude}},{{$retailer->longitude}},20z?hl=vi-VN" target="_blank" style="">Tìm đường</a>--}}
                                            {{--<a class="arrow-right">--}}
                                                    {{--<span>--}}
                                                        {{--<i class="fa fa-angle-right" aria-hidden="true"></i>--}}
                                                    {{--</span>--}}
                                            {{--</a>--}}
                                            {{--<p data-latitude="{{$retailer->latitude}}"--}}
                                               {{--data-longitude="{{$retailer->longitude}}"--}}
                                               {{--class="button-desktop button-view">--}}
                                                {{--<a href="https://www.google.com/maps/@.{{$retailer->latitude}},20z?hl=vi-VN" target="_blank">Tìm đường</a>--}}
                                                {{--<a class="arrow-right">--}}
                                                    {{--<span>--}}
                                                        {{--<i class="fa fa-angle-right" aria-hidden="true"></i>--}}
                                                    {{--</span>--}}
                                                {{--</a>--}}
                                            {{--</p>--}}
                                            {{--<p class="button-mobile button-view" data-latitude="{{$retailer->latitude}}"--}}
                                               {{--data-longitude="{{$retailer->longitude}}">--}}
                                                {{--<a href="https://www.google.com/maps/@.{{$retailer->latitude}},{{$retailer->latitude}},20z?hl=vi-VN" target="_blank">Tìm đường</a>--}}
                                                {{--<a class="arrow-right">--}}
                                                    {{--<span>--}}
                                                        {{--<i class="fa fa-angle-right" aria-hidden="true"></i>--}}
                                                    {{--</span>--}}
                                                {{--</a>--}}
                                            {{--</p>--}}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <style>
        #footer-vuanem {
            padding: 0 25px 0 10px;
        }

        .page-title {
            margin-top: 15px;
            margin-left: -15px;
            font-size: 14px;
            text-transform: none;
            color: #20315c;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .search-wrapper {
            min-height: 600px;
            background: #fff;
        }

        .google-map-wrapper {
            flex: 0 0 58%;
            max-width: 58%;

        }

        .google-map-embed {
            height: 100%;
        }

        .google-map-embed embed {
            width: 100%;
            height: 100%;
        }

        ul.listing-store-result {
            margin: 0;
                overflow: auto;
                max-height: 655px;
                padding: 0;
                background-color: #fff;
                border: 1px solid #F6EBFF;
                box-sizing: border-box;
                border-radius: 4px;
        }
        .details >p {line-height: 28px;}
        .heading > p{    font-size: 14px;
            font-weight: 600;
            color: #001F86;
        }
        .listing-store-result li.result-item {
            position: relative;
            border-bottom: 1px solid #EDEDED;
            padding: 20px 0 8px 25px;
            list-style: none;
        }

        .listing-store-result li.result-item:hover {
            background-color: #f9f6ff;
        }

        .listing-store-result div {
            padding-right: 100px;
        }

        .listing-store-result .details a {
            color: #fff;
            font-size: 12px;
            text-decoration: none;
            line-height: normal;
            display: block;
            text-transform: uppercase;
        }

        .listing-store-result li.result-item .button-desktop {
            margin-right: 12px;
        }

        .listing-store-result li.result-item .button-desktop a {
            color: #fff;
        }

        .listing-store-result li.result-item .button-view.button-desktop:hover {
            background: #292bb7;
        }

        .listing-store-result li.result-item .button-view.button-desktop {
            position: absolute;
            right: 0;
            top: 50%;
            width: 80px;
            z-index: 1;
            -webkit-transform: translateY(-50%);
            height: 80px;
            transform: translateY(-50%);
            -o-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            background-color: #acb9cb;
            padding: 10px;
            cursor: pointer;
            -webkit-transition: all .3s;
            transition: all .3s;
            background: #acb9cb;
        }

        .listing-store-result .details .button-mobile {
            display: none;
        }

        .listing-store-result .details .arrow-right {
            height: 100%;
            width: 100%;
            position: absolute;
            left: 0;
            z-index: 11;
            top: 0;
            cursor: pointer;
        }

        .listing-store-result .details .button-desktop .arrow-right span {
            color: #fff;
            width: 40px;
            position: absolute;
            bottom: 3px;
            height: 23px;
            right: 10px;
            text-align: right;
            line-height: 23px;
            font-size: 23px;
            display: block;
        }

        .listing-store-result .details .button-desktop .arrow-right span:before {
            content: "";
            height: 1px;
            width: 25px;
            background: #fff;
            position: absolute;
            left: 14px;
            top: 11px;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }


        body {
            font-size: 15px;
        }
        .store-search > p{color: #000F40;
            font-size: 16px;}
.select-search p{padding-top: 15px;margin-bottom: 10px;}
        .select-search {
            border-bottom: 1px solid #c2c2c2;
            padding: 10px 20px 30px;
            color: #000F40;
            font-size: 16px;
            background: linear-gradient(180deg, #F7F4FF 11.94%, rgba(247, 244, 255, 0) 100%);
            border: 1px solid #F6EBFF;
            box-sizing: border-box;
            border-radius: 4px;
        }

        .search-result-header {
            padding: 0;
        }

        .search-result-header .result-count {
            color: #000F40;font-size: 16px; 
            padding: 4px 20px;
            margin-bottom: 0.5rem;
        }
        .search-result-header .result-count .pull-right{display: none;}
.details p{color: #525252;}
        .select-box {
            width: 100%;
            background-color: white;
            border: 1px solid #AD8AC9;
            display: inline-block;
            font: inherit;color: #410077;
            line-height: 1.5em;font-size: 18px;
            padding: 0.5em 3.5em 0.5em 1em;

            /* reset */

            margin: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, gray 50%),
            linear-gradient(135deg, gray 50%, transparent 50%),
            linear-gradient(to right, #ccc, #ccc);
            background-position: calc(100% - 20px) calc(1em + 2px),
            calc(100% - 15px) calc(1em + 2px),
            calc(100% - 2.5em) 0.5em;
            background-size: 5px 5px,
            5px 5px,
            1px 1.5em;
            background-repeat: no-repeat;
        }

        .select-box:focus {
            background-image: linear-gradient(45deg, green 50%, transparent 50%),
            linear-gradient(135deg, transparent 50%, green 50%),
            linear-gradient(to right, #ccc, #ccc);
            background-position: calc(100% - 15px) 1em,
            calc(100% - 20px) 1em,
            calc(100% - 2.5em) 0.5em;
            background-size: 5px 5px,
            5px 5px,
            1px 1.5em;
            background-repeat: no-repeat;
            border-color: green;
            outline: 0;
        }

        /* mobile */
        @media (max-width: 767px) {
            .select-search .title-map {
                display: none;
            }

            .select-search .select-box.select-city {
                margin-bottom: 15px;
            }

            .google-map-wrapper {
                display: none;
            }

            . {
                position: relative;
                display: block;
                clear: both;
            }

            .button-mobile.button-view {
                display: block !important;
                background-color: #acb9cb;
                padding: 10px;
                cursor: pointer;
                -webkit-transition: all .3s;
                transition: all .3s;
            }

            .button-desktop {
                display: none;
            }

            .listing-store-result div {
                padding-right: 10px;
            }

            .listing-store-result .details .button-mobile .arrow-right span:before {
                content: "";
                height: 2px;
                width: 25px;
                background: #fff;
                position: absolute;
                right: 7px;
                bottom: 35px;
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }

            .listing-store-result .details .arrow-right span {
                color: #fff;
                width: 40px;
                position: absolute;
                bottom: 2px;
                height: 48px;
                right: 30px;
                text-align: right;
                line-height: 23px;
                font-size: 23px;
                display: block;
            }

            .listing-store-result .details a {
                font-size: 17px;
            }
        }


        .active-button {
            background: #292bb7 !important;
        }

    </style>
@endsection

@push('scripts')
    <script>


        $(document).ready(function () {
            $(".listing-store-result").on("click", '.button-view', function () {
                let latitude = $(this).attr("data-latitude");
                let longitude = $(this).attr("data-longitude");
                map.setCenter(new google.maps.LatLng(latitude, longitude));
                map.setZoom(18);
            });

            $('.button-desktop.button-view').on('click', function () {
                $('.button-desktop.button-view').removeClass('active-button');
                $(this).addClass('active-button');
            });

            $("select.select-city").change(function () {
                const province = $(this).children("option:selected").val();
                $.ajax({
                    type: 'GET',
                    url: '/ajax/getStoreDistrict',
                    data: {'id': province},
                    success: function (data) {
                        $(".select-district").find(".district-get").remove().end().append(data);
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '/ajax/getStore',
                    data: {
                        'province': province
                    },
                    success: function (data) {
                        $(".listing-store-result").find("li").remove().end().append(data['str']);
                        $(".count-result").find("span").remove().end().text(data['retailerAddress'].length);
                    }
                });
            });


            $("select.select-district").change(function () {
                const province = $("select.select-city").children("option:selected").val();
                const district = $(this).children("option:selected").val();
                $.ajax({
                    type: 'GET',
                    url: '/ajax/getStore',
                    data: {
                        'province': province,
                        'district': district
                    },
                    success: function (data) {
                        $(".listing-store-result").find("li").remove().end().append(data['str']);
                        $(".count-result").find("span").remove().end().text(data['retailerAddress'].length);
                    }
                });
            });
			$("#storeDistant").click(function () {
                console.log(1111);
				if (navigator.geolocation) {

					navigator.geolocation.getCurrentPosition(function (position) {
						$.ajax({
							type: 'GET',
							url: '{{route("ajax.getStoreDistance")}}',
							data: {
								'latitude': position.coords.latitude,
								'longitude': position.coords.longitude
							},
							success: function (data) {
								console.log(data);
								initMap(data['retailerAddress'], 4);
								$(".listing-store-result").find("li").remove().end().append(data['str']);
								$(".count-result").find("span").remove().end().text(data['retailerAddress'].length);
							}
						});
					});
				}
			});

        });
    </script>
@endpush
