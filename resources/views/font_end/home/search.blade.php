@extends('layouts.new_master_homepage')
@push('css')
<link rel="stylesheet" href="{{url("web/css/search.css")}}">
@endpush
@section('content')
<!-- BreadCrumb -->
<div class="section-breadcrumb">
  <ol>
    <li>
      <a href={{route('home')}} class="breadcrumb-link">Trang Chủ</a>
      <span class="breadcrumb-separator">/</span>
    </li>
    <li>
      <span class="breadcrumb-text">Tìm kiếm</span>
      <span class="breadcrumb-separator">/</span>
    </li>
  </ol>
</div>
<!-- End BreadCrumb -->
<div class="result">
  <div class="result-title">Có {{$products->count()}} kết quả với từ khoá “ {{$keyword}} “</div>
  <div class="list-products">
    @foreach ($products as $product)
      <div class="item">
        <a href={{route('product.detail', $product->id)}}>
          <img data-src="{{route("productImageShow", [
              "id" => $product->id,
              "size" => 609,
              "fileName" => $product->images->first()->name
            ])}}" alt="" class="lazyload product-image">
          <h2 class="product-name">{{$product->name}}</h2>
        </a>
        <div class="block-price">
          <div class="product-price">
            <p class="price">{{price($product->price)}} đ</p>
            <p class="compare-price">{{price($product->compare_price)}} đ</p>
          </div>
          <div class="installment-price">
            <p>Giá trả góp từ:</p>
            <label>493.000</label>&nbsp;
            <span>đ/Tháng</span>
          </div>
        </div>
        <a href="{{route('product.detail', $product->id)}}" class="buy-now">
          Mua ngay
          <img class="lazyload" data-src="{{url('web/newImage/home/right-arrow.svg')}}" alt="" />
        </a>
      </div>
    @endforeach
  </div>
</div>
@endsection
