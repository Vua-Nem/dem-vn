@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="{{url("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("css/footer.css")}}">
    <link rel="stylesheet" href="{{url("css/style.css")}}">
    <link rel="stylesheet" href="{{url("css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{url("css/font-style.css")}}">
    <link rel="stylesheet" href="{{url("css/slick-theme.css")}}">
    <link rel="stylesheet" href="{{url("")}}">
@endpush
@section('content')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKeySwyKZHoW1zo-fks0zyf-bYenoZpSE&callback=initMap&libraries=&v=weekly" defer></script>
    <div class="container smile-store-locator-store-view">
        <div class="page-title-wrapper">
            <h1 class="page-title">
                <span class="base" data-ui-id="page-title-wrapper" itemprop="name">{{ $retailerAddress->name}}</span>
            </h1>
        </div>
        <div class="columns">
            <div class="column main">
                <div class="shop-details">
                    <div class="shop-informations">
                        <div id="map" style="height: 500px;width: 100%"></div>
                        <div class="address-info">
                            <div class="box-title">
                                <p>Địa chỉ cửa hàng</p>
                            </div>
                            <div class="address">
                                {{ $retailerAddress->address}}
                                <a style="color:#3ac2cc" target="_blank"
                                   href="https://www.google.com/maps/dir//21.0158442,105.8323351/@21.0158442,105.8323351">
                                    <em>Chỉ đường <i class="fa fa-external-link" aria-hidden="true"></i> </em></a>
                            </div>
                        </div>
                        <div id="google-reviews">
                            <style>
                                #google-reviews {
                                    flex: 0 0 100%;
                                    padding: 0 0 0 10px;
                                }

                                .google-reviews_link {
                                    padding: 7px 0 0;
                                }

                                .google-reviews_link a {
                                    font-size: 110%;
                                    color: #3ac2cc;
                                }

                                .star-ratings-sprite {
                                    background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
                                    font-size: 0;
                                    height: 21px;
                                    line-height: 0;
                                    overflow: hidden;
                                    text-indent: -999em;
                                    width: 110px;
                                    margin: 0 0 0 25px;
                                }

                                .star-ratings-sprite-rating {
                                    background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
                                    background-position: 0 100%;
                                    float: left;
                                    height: 21px;
                                    display: block;
                                }
                            </style>
                            <div>
                                <div class="star-ratings-sprite"><span style="width:0%"
                                                                       class="star-ratings-sprite-rating"></span></div>
                            </div>
                            <div class="google-reviews_link">
                                <a target="_blank" href="">Viết đánh giá trên Google</a>
                            </div>
                        </div>
                        <div class="store_info_wrapper">
                            <div class="contact-info">
                                <div class="contact-info-wrapper">
                                    <h3>Liên hệ</h3>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td><span>Điện thoại : </span><span itemprop="telephone">{{ $retailerAddress->phone_store}} - Máy lẻ: {{ $retailerAddress->extension_number}}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="opening-hours-container">
                                <div class="opening-hours-info" data-bind="scope: 'smile-storelocator-store'">
                                    <div data-bind="{template: { name: schedule().openingHoursTemplate, data: schedule() }}">
                                        <div data-block="opening-hours-info">
                                            <div class="box-title">
                                                <p data-bind="i18n: 'Opening Hours'">Giờ mở cửa</p>
                                                <div class="opening-hours showopeninghours">
                                                    <a href="#" onclick="return false;"
                                                       data-bind="text: getLinkLabel(), css: { isOpen: isOpenNow() == true, isClosed: isOpenNow() == false }"
                                                       class="opening-hours-label isOpen">Mở cửa hôm nay (08:30 -
                                                        21:00)</a>
                                                </div>
                                            </div>

                                            <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front mage-dropdown-dialog"
                                                 tabindex="-1" role="dialog" aria-describedby="ui-id-3"
                                                 style="display: none;">
                                                <div class="block catalog-product-stores-availability-content ui-dialog-content ui-widget-content"
                                                     data-role="openingHoursDropDown" id="ui-id-3">
                                                    <div class="opening-hours">
                                                        <table class="opening-hours-table">
                                                            <tbody data-bind="{foreach: openingHoursList}"
                                                                   data-role="opening-hours-table">
                                                            <tr data-bind="css: { currentDay: $parent.isCurrentDay(day) == true }">
                                                                <td class="opening-row" data-bind="text:day">Chủ Nhật
                                                                </td>
                                                                <td class="opening-row" data-bind="text:hours">08:30 -
                                                                    21:00
                                                                </td>
                                                            </tr>

                                                            <tr data-bind="css: { currentDay: $parent.isCurrentDay(day) == true }">
                                                                <td class="opening-row" data-bind="text:day">Thứ Hai
                                                                </td>
                                                                <td class="opening-row" data-bind="text:hours">08:30 -
                                                                    21:00
                                                                </td>
                                                            </tr>

                                                            <tr data-bind="css: { currentDay: $parent.isCurrentDay(day) == true }">
                                                                <td class="opening-row" data-bind="text:day">Thứ Ba</td>
                                                                <td class="opening-row" data-bind="text:hours">08:30 -
                                                                    21:00
                                                                </td>
                                                            </tr>

                                                            <tr data-bind="css: { currentDay: $parent.isCurrentDay(day) == true }">
                                                                <td class="opening-row" data-bind="text:day">Thứ Tư</td>
                                                                <td class="opening-row" data-bind="text:hours">08:30 -
                                                                    21:00
                                                                </td>
                                                            </tr>

                                                            <tr data-bind="css: { currentDay: $parent.isCurrentDay(day) == true }"
                                                                class="currentDay">
                                                                <td class="opening-row" data-bind="text:day">Thứ Năm
                                                                </td>
                                                                <td class="opening-row" data-bind="text:hours">08:30 -
                                                                    21:00
                                                                </td>
                                                            </tr>

                                                            <tr data-bind="css: { currentDay: $parent.isCurrentDay(day) == true }">
                                                                <td class="opening-row" data-bind="text:day">Thứ Sáu
                                                                </td>
                                                                <td class="opening-row" data-bind="text:hours">08:30 -
                                                                    21:00
                                                                </td>
                                                            </tr>

                                                            <tr data-bind="css: { currentDay: $parent.isCurrentDay(day) == true }">
                                                                <td class="opening-row" data-bind="text:day">Thứ Bảy
                                                                </td>
                                                                <td class="opening-row" data-bind="text:hours">08:30 -
                                                                    21:00
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-bind="afterRender: initDropdown"></div>
                                    </div>
                                </div>
                                <div class="opening-hours-info" data-bind="scope: 'smile-storelocator-store'">
                                    <div data-bind="{template: { name: schedule().specialOpeningHoursTemplate, data: schedule() }}">
                                        <div class="box-title" data-bind="visible:hasSpecialOpeningHours()"
                                             style="display: none;">
                                            <p data-bind="i18n: 'Special Opening Hours'">Giờ mở cửa đặc biệt</p>
                                        </div>
                                        <div class="opening-hours" data-bind="visible:hasSpecialOpeningHours()"
                                             style="display: none;">
                                            <table class="opening-hours-table">
                                                <tbody data-bind="foreach: specialOpeningHoursList()"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <meta itemprop="openingHours"
                                      content="Su 08:30-21:00,Mo 08:30-21:00,Tu 08:30-21:00,We 08:30-21:00,Th 08:30-21:00,Fr 08:30-21:00,Sa 08:30-21:00">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .page-title-wrapper {
            text-transform: uppercase;
        }

        .page-main > .page-title-wrapper .page-title {
            display: inline-block;
        }

        h1 {
            font-weight: 300;
            line-height: 1.1;
            font-size: 2rem;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }

        .smile-store-locator-store-view .shop-details {
            box-shadow: 0px 1px 1px rgb(0 0 0 / 20%);
            border: 1px solid #ccc;
            margin: 10px 0 26px;
        }

        .smile-store-locator-store-view .shop-details, .smile-store-locator-store-search .shop-details {
            width: 100%;
        }

        .smile-store-locator-store-view .shop-informations {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .smile-store-locator-store-view .shop-informations .store-view-map {
            flex: 0 0 100%;
        }

        .smile-store-locator-store-view .shop-details .map, .smile-store-locator-store-search .shop-details .map {
            width: 100%;
            border-bottom: 1px solid #ccc;
            z-index: 1;
        }

        .leaflet-container.leaflet-touch-drag.leaflet-touch-drag {
            -ms-touch-action: none;
            touch-action: none;
        }

        .leaflet-container {
            background: #ddd;
            outline: 0;
        }

        .smile-store-locator-store-view .shop-details .address-info, .smile-store-locator-store-search .shop-details .address-info {
            display: flex;
            padding: 10px;
            font-size: 120%;
        }

        .smile-store-locator-store-view .shop-details .address-info .box-title, .smile-store-locator-store-search .shop-details .address-info .box-title {
            margin-right: 10px;
            font-weight: 700;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .smile-store-locator-store-view .shop-details .address-info .address, .smile-store-locator-store-search .shop-details .address-info .address {
            flex: 1;
        }

        .smile-store-locator-store-view .shop-details .address-info .address, .smile-store-locator-store-search .shop-details .address-info .address {
            color: #3ac2cc;
        }

        #google-reviews {
            flex: 0 0 100%;
            padding: 0 0 0 10px;
        }

        .smile-store-locator-store-view .shop-informations .contact-info {
            width: 100%;
        }

        .smile-store-locator-store-view .shop-informations .contact-info .contact-info-wrapper {
            padding: 10px;
            margin-right: 10px;
            margin-bottom: 10px;
            max-height: 200px;
        }

        .smile-store-locator-store-view .shop-informations .contact-info .contact-info-wrapper h3 {
            margin-top: 0;
        }

        h3 {
            font-weight: 600;
            line-height: 1.1;
            font-size: 1.4rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: 1.6rem;
        }

        .smile-store-locator-store-view .shop-informations .opening-hours-container {
            width: 100%;
        }

        .smile-store-locator-store-view .shop-details .opening-hours-info, .smile-store-locator-store-search .shop-details .opening-hours-info {
            padding: 10px;
            clear: both;
        }

        .smile-store-locator-store-view .shop-details .opening-hours-info .box-title p, .smile-store-locator-store-search .shop-details .opening-hours-info .box-title p {
            font-weight: 700;
            float: left;
        }

        .smile-store-locator-store-view .shop-details .opening-hours-info .box-title .showopeninghours, .smile-store-locator-store-search .shop-details .opening-hours-info .box-title .showopeninghours {
            float: left;
            margin-left: 10px;
            cursor: pointer;
            font-weight: 700;
            font-size: 13px;
        }
        .block-icon-seach{
            display: none;
        }
    </style>

@endsection
@push('scripts')
    <script>
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng('{{$retailerAddress->latitude}}', '{{$retailerAddress->longitude}}'),
                zoom: 18,
            });

            marker = new google.maps.Marker({
                position: new google.maps.LatLng('{{$retailerAddress->latitude}}', '{{$retailerAddress->longitude}}'),
                icon: 'https://vuanem.com/static/version1610533911/frontend/Codazon/fastest_furniture/vi_VN/Smile_Map/leaflet/images/marker-icon-red.png',
                map: map,
            });
        }
    </script>
@endpush