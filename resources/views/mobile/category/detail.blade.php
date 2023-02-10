@extends('layouts.new_mobile_homepage')
@push('css')
<link rel="stylesheet" href="{{url("mobile/css/list.css")}}">
<link rel="stylesheet" href="{{url("mobile/css/slick-theme.css")}}">
@endpush
@section('content')
<!-- Slider -->
<div class="carousel slide section-slider" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach($banners as $key => $banner)
      <div class="carousel-item @if($key == 0)active @endif">
        <a href={{$banner->url}} target="_blank">
          <img data-src="{{route("showImageBanner", [
            "fileName" => $banner->name
          ])}}" alt="" class="lazyload w-100 d-block">
        </a>
      </div>
    @endforeach
  </div>
</div>
<!-- End Slider -->
<!-- BreadCrumb -->
<div class="section-breadcrumb">
  <ol>
    <li>
      <a href={{route('home')}} class="breadcrumb-link">Trang Chủ</a>
      <span class="breadcrumb-separator">/</span>
    </li>
    <li>
      <span class="breadcrumb-text">{{$category->name}}</span>
      <span class="breadcrumb-separator">/</span>
    </li>
  </ol>
</div>
<!-- End BreadCrumb -->
<!-- Block product -->
<div class="section-list-product">
  <h2 class="block-title">Block sản phẩm {{$category->name}}</h2>
  <p class="block-des">{{$category->description}}</p>
  <div class="products">
    @foreach($products as $product)
      @php
      if ($product->compare_price == 0) {
        $saleRate = 0;
      }
      else {
        $saleRate = ceil((1 - ($product->price / $product->compare_price)) * 100);
      }
      @endphp
      <div class="item">
        <a href={{route('product.detail', $product->slug)}}>
          <div class="product-image">
            @if(!empty($product->images->first()))
            <img data-src="{{route("productImageShow", [
                "id" => $product->id,
                "size" => 609,
                "fileName" => $product->images->first()->name
              ])}}" alt="" class="lazyload" width="640" height="400">
            @else
            <img data-src="{{route("productImageShow", [
                "id" => $product->id,
                "fileName" => "default.jpg"
              ])}}" alt="" class="image-product lazyload">
            @endif
            @if($saleRate > 0)
            <span class="sale-rate">-{{$saleRate}}%</span>
            @endif
          </div>
          <h2 class="product-name">{{$product->name}}</h2>
        </a>
        <div class="review-stars">
          <div class="stars">
            <img class="lazyload" data-src="{{url('mobile/newImage/detail/star.svg')}}" alt="">
            <img class="lazyload" data-src="{{url('mobile/newImage/detail/star.svg')}}" alt="">
            <img class="lazyload" data-src="{{url('mobile/newImage/detail/star.svg')}}" alt="">
            <img class="lazyload" data-src="{{url('mobile/newImage/detail/star.svg')}}" alt="">
            <img class="lazyload" data-src="{{url('mobile/newImage/detail/no-star.svg')}}" alt="">
          </div>
          <span class="review-num">{{$product->reviews->count()}}</span>
        </div>
        <ul class="short-desc">
          <li>Cao su thiên nhiên</li>
          <li>Bảo vệ cột sống</li>
          <li>Hương Vanila dịu nhẹ</li>
        </ul>
        <p class="price">{{price($product->price)}} đ</p>
        <p class="compare-price">{{price($product->compare_price)}} đ</p>
        <div class="installment-price">
          Giá trả góp từ:&nbsp;
          <label>493.000</label>&nbsp;
          <span>đ/Tháng</span>
        </div>
        <a href="{{route('product.detail', $product->slug)}}" class="buy-now">
          Mua ngay
          <img class="lazyload" data-src="{{url('mobile/newImage/home/right-arrow.svg')}}" alt="" />
        </a>
      </div>
    @endforeach
  </div>
<div id="app-pagination">
  {{ $products->links('vendor.pagination.bootstrap-4') }}
</div>
</div>
<!-- End Block product -->
{{ Widget::run('usp') }}
@endsection
