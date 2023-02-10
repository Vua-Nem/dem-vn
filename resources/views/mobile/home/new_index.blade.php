@extends('layouts.new_mobile_homepage')
@push('css')
<link rel="stylesheet" href="{{url("mobile/css/homepage1.css")}}">
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
{{ Widget::run('usp') }}
<!-- About us -->
<div class="section-banner">
  <div class="content-section">
    <h2 class="title">Tiết kiệm tới <span>30%</span> tại Dem.vn</h2>
    <p>Bạn có biết bạn có thể tiết kiệm tới 30% chi phí mua đệm trên Dem.vn.</p>
    <div class="button-action">
      <a href="#" class="">Xem thêm</a>
    </div>
  </div>
  <img class="lazyload image-banner" data-src="{{url('mobile/newImage/home/block-fearture.jpg')}}" alt="">
</div>
<!-- End About us -->
<!-- Block product -->
<div class="section-products">
  @foreach($categories as $category)
    @if (!$category->products->isEmpty())
    <div class="block-product">
      <h2 class="block-title">
        <a href="{{route('category.detail', $category->slug)}}">Block sản phẩm {{$category->name}}</a>
      </h2>
      <p class="block-des">{{ $category->description }}</p>
      <div class="items-product">
        @foreach($category->products as $product)
        @php
        if ($product->compare_price == 0) {
          $saleRate = 0;
        }
        else {
          $saleRate = ceil((1 - ($product->price / $product->compare_price)) * 100);
        }
        @endphp
        <div class="item">
          <a href="{{route('product.detail', $product->slug)}}">
            <div class="product-image">
              @if(!empty($product->images->first()))
                <img data-src="{{route("productImageShow", [
                  "id" => $product->id,
                  "size" => 609,
                  "fileName" => $product->images->first()->name
                ])}}" alt="" class="lazyload" height="315">
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
              <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
              <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
              <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
              <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
              <img class="lazyload" data-src="{{url('web/newImage/detail/no-star.svg')}}" alt="">
            </div>
            <span class="review-num">{{$product->reviews->count()}}</span>
          </div>
          <ul class="short-desc">
            @if (!empty($product->shortDescriptions))
              @foreach ($product->shortDescriptions as $shortDescription)
                <li>{{ $shortDescription->name }}</li>
              @endforeach
            @endif
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
            <img class="lazyload" data-src="{{url('web/newImage/home/right-arrow.svg')}}" alt="" />
          </a>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  @endforeach
</div>
<!-- End Block product -->
<!-- Policy -->
<div class="section-policy">
  <div class="content-section">
    <h2 class="title">CHÍNH SÁCH 1-0-2</h2>
    <p>
      Thật khó để biết một chiếc đệm có phù hợp với mình không chỉ qua một hai lần nằm thử tại cửa hàng. Dem.vn dành
      tặng 102 đêm ngủ thử miễn phí. Chính sách có 1-0-2 giúp bạn yên tâm đặt trước sản phẩm để trải nghiệm trước
      khi gắn bó lâu dài.<br /><br />
      Trong thời gian nằm thử, nếu bạn không cảm thấy hài lòng với chiếc đệm đã lựa chọn, bạn có thể dễ dàng đổi
      sang chiếc đệm khác phù hợp hơn.
    </p>
    <a href="#">Xem thêm</a>
  </div>
</div>
<!-- End Policy -->
<!-- Certificate -->
<div class="section-certificate">
  <h2 class="title-section">Đệm Đạt Tiêu Chuẩn Quốc Tế</h2>
  <div class="des-section">Các sản phẩm của Dem.vn đều đạt các chứng chỉ uy tín về chất lượng</div>
  <div class="items-section">
    <div class="item-certificate">
      <div class="icon">
        <img class="lazyload m-auto" data-src="{{url("web/newImage/home/certificate1.png")}}" alt="">
      </div>
      <div class="desc">Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng đến sức khỏe người
        dùng như formaldehyde, thuốc <br> trừ sâu, kim loại nặng chiết xuất được...</div>
    </div>
    <div class="item-certificate">
      <div class="icon">
        <img class="lazyload m-auto" data-src="{{url("web/newImage/home/certificate2.png")}}" alt="">
      </div>
      <div class="desc">Chứng nhận đảm bảo chất lượng toàn diện, chứng nhận sản phẩm phù hợp với tiêu chuẩn ISO
        9001:2015</div>
    </div>
    <div class="item-certificate">
      <div class="icon">
        <img class="lazyload m-auto" data-src="{{url("web/newImage/home/certificate3.png")}}" alt="">
      </div>
      <div class="desc">Chứng nhận tổ chức đạt tiêu chuẩn về trách nhiệm xã hội BSCI – BUSINESS SOCIAL COMPLIANCE
        INITIATIVE do tổ chức INTERTEK xác nhận</div>
    </div>
    <div class="item-certificate">
      <div class="icon">
        <img class="lazyload m-auto" data-src="{{url("web/newImage/home/certificate4.png")}}" alt="">
      </div>
      <div class="desc">Đây là chứng chỉ trong dệt may, đảm bảo loại bỏ các chất gây ảnh hưởng đến sức khỏe người
        dùng như formaldehyde, thuốc trừ sâu, kim loại nặng ...</div>
    </div>
  </div>
</div>
<!-- End Certificate -->
<!-- Contact -->
@if (!Session::has('contact'))
  <div class="section-contact">
    <div class="item-section">
      <h2>NHẬN VOUCHER LÊN ĐẾN&nbsp;
        <label>1.000.000</label>&nbsp;
        <span>đ</span>
      </h2>
      <div class="position-relative">
        <form method="post" action={{route('contact')}}>
          @csrf
          <input placeholder="Số điện thoại của bạn" type="text" name="phone" />
          <button type="submit">Xác nhận</button>
        </form>
      </div>
    </div>
  </div>
@endif
<!-- End Contact -->
@endsection