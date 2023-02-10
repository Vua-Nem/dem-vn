@extends('layouts.new_master_homepage')
@push('css')
<link rel="stylesheet" href="{{url("web/css/detail.css")}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.3.2/css/lightgallery.css" />
@endpush
@section('content')
<!-- BreadCrumb -->
<div class="section-breadcrumb">
  <ol>
    <li>
      <a href="{{route('home')}}" class="breadcrumb-link">Trang Chủ</a>
      <span class="breadcrumb-separator">/</span>
    </li>
    <li>
      <a href={{route('category.detail', $product->category->slug)}} class="breadcrumb-link">{{$product->category->name}}</a>
      <span class="breadcrumb-separator">/</span>
    </li>
    <li>
      <span class="breadcrumb-text">{{$product->name}}</span>
      <span class="breadcrumb-separator">/</span>
    </li>
  </ol>
</div>
<!-- End BreadCrumb -->
<!-- Product -->
<div class="main-page">
  <form id="add-to-cart" method="post" action="{{route("cart.addcart")}}">
    {{csrf_field()}}
    <div class="section-product">
      <div class="image-product-wrapper">
        <div id="product-images">
          <div id="main-image-product" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <?php $i = 1; ?>
              @foreach($product->images as $img)
              <div class="carousel-item @if($i == 1) active @endif" data-index="<?php echo $i; ?>">
                <img class="lazyload" data-src="{{route("productImageShow", ["id" => $product->id, "size" => 609, "fileName" => $img->name])}}" width="900" height="602" alt="">
              </div>
              <?php $i++; ?>
              @endforeach
            </div>
            <a class="carousel-control-prev left carousel-control" href="#main-image-product" data-slide="prev">
              <img class="lazyload slick-prev" data-src="{{url('web/newImage/home/prev_icon.svg')}}" alt="" />
            </a>
            <a class="carousel-control-next right carousel-control" href="#main-image-product" data-slide="next">
              <img class="lazyload slick-next" data-src="{{url('web/newImage/home/next_icon.svg')}}" alt="" />
            </a>
          </div>
          <div id="lightgallery-detail">
            <?php $i = 1; ?>
            @foreach($product->images as $img)
              <div class="items-image-<?php echo $i ?> product-thumbnail" href="{{route("showImage2", ["folder" => "products","id" => $product->id, "fileName" => $img->name])}}">
                <img class="lazyload w-100" data-src="{{route("productImageShow", ["id" => $product->id,"size"=>609, "fileName" => $img->name])}}" alt="">
              </div>
              <?php $i++; ?>
            @endforeach
          </div>
        </div>
        <div class="policies">
          <div class="item">
            <img class="lazyload" data-src="{{url('web/newImage/detail/policy_1.svg')}}" alt="" />
            <p>180 ngày&nbsp;<span>ngủ thử</span></p>
          </div>
          <div class="item">
            <img class="lazyload" data-src="{{url('web/newImage/detail/policy_2.svg')}}" alt="" />
            <p>Vận chuyển&nbsp;<span>Miễn Phí</span></p>
          </div>
          <div class="item">
            <img class="lazyload" data-src="{{url('web/newImage/detail/policy_3.svg')}}" alt="" />
            <p>Bảo hành&nbsp;<span>Chính Hãng</span></p>
          </div>
        </div>
      </div>
      <div class="product-wrapper">
        <div class="product-header">
          <div class="product-name">{{$product->name}}</div>
          <div class="review-stars">
            <div class="stars">
              <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
              <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
              <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
              <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
              <img class="lazyload" data-src="{{url('web/newImage/detail/no-star.svg')}}" alt="">
            </div>
            <span class="review-num">{{$reviews->count()}}</span>
          </div>
        </div>
        <ul class="short-desc">
            @if (!empty($product->shortDescriptions))
              @foreach ($product->shortDescriptions as $shortDescription)
                <li>{{ $shortDescription->name }}</li>
              @endforeach
            @endif
        </ul>
        <div class="section-price">
          <?php $i = 0; ?>
          @foreach($product->variants as $variant)
          <div class="product-price @if($i == 0){{"active"}}@endif" id="price_{{$variant->id}}">
            <p class="compare-price">{{price($variant->compare_price)}} đ</p>
            <p class="price ga-product-price" data-price="{{$variant->price}}" data-sku="{{$variant->sku}}">{{price($variant->price)}} đ</p>
          </div>
          <?php $i++; ?>
          @endforeach
          <div class="installment-price">
            <p>Giá trả góp từ:</p>
            <label>493.000</label>
            <span>đ/Tháng</span>
          </div>
        </div>
        <div class="block-variant">
          <?php $i = 0; ?>
          @foreach($attributeName as $keyCode => $name)
          <div class="variant {{$keyCode}}">
            <div class="title">{{$name}}</div>
            <div class="position-relative">
              @if($i == 0)
              <select class="attribute_group_name">
                <?php $gCount = 0; ?>
                @foreach ($attributeGroup as $key => $values)
                <option class="@if($gCount == 0) {{"active"}}@endif" id="{{\Illuminate\Support\Str::slug($key, "_")}}">{{$key}}</option>
                <?php $gCount++; ?>
                @endforeach
              </select>
              @endif

              @if($i == 1)
              <?php $gCount = 0; ?>
              @foreach ($attributeGroup as $key => $values)
              <select class="product_variant_option @if($gCount == 0){{"active"}}@endif" id="value_{{\Illuminate\Support\Str::slug($key, "_")}}">
                @foreach ($values as $key => $value)
                <option class="@if($gCount == 0){{"active"}}@endif" value={{$key}} @if($gCount==0) selected @endif>{{$value}}</option>
                @endforeach
              </select>
              <?php $gCount++; ?>
              @endforeach
              @endif
              <input type="hidden" name="product_variant" value="" >
              <img class="lazyload arrow-down" data-src="{{url('web/newImage/detail/arrow_down.svg')}}" alt="">
            </div>

          </div>
          <?php $i++; ?>
          @endforeach
        </div>
        <button class="add-to-cart js-ga-add-to-cart" data-product-name="{{$product->name}}" data-product-id="{{$product->id}}" data-product-price="{{$product->price}}" data-product-brand="{{$product->brand->name}}" data-product-variant="" type="button">
          <img class="lazyload" data-src="{{url('web/newImage/detail/cart.svg')}}" alt="">
          <span>Thêm vào giỏ hàng</span>
        </button>
        <div class="list-payment-method">
          <div class="title-list">
            <img src="{{url("web/newImage/detail/ic-title-payment.svg")}}" alt="icon title payment">Các phương thức thanh toán được chấp
            nhận
          </div>
          <div class="items-payment">
            <img src="{{url('web/newImage/detail/ic-payment-all.svg')}}" alt="list payment">
          </div>
        </div>
      </div>
    </div>
  </form>
  <div class="section-func">
    <div class="func-item">
      <img class="lazyload" data-src="{{url('web/newImage/detail/func-icon-1.svg')}}" alt="">
      <span>Sleep Cooler</span>
    </div>
    <div class="func-item">
      <img class="lazyload" data-src="{{url('web/newImage/detail/func-icon-2.svg')}}" alt="">
      <span>Designed to Enhance Sleep</span>
    </div>
    <div class="func-item">
      <img class="lazyload" data-src="{{url('web/newImage/detail/func-icon-3.svg')}}" alt="">
      <span>Alleviates Pressure Points</span>
    </div>
    <div class="func-item">
      <img class="lazyload" data-src="{{url('web/newImage/detail/func-icon-4.svg')}}" alt="">
      <span>Eco-Friendly Production</span>
    </div>
  </div>
  <div class="product-description">
    {!! $product->description->description !!}
  </div>
  <div class="section-review">
    {{-- <div>Sắp xếp</div> --}}
    <div class="block-review">
      <div class="general-review-block">
        <h2 class="title">Đánh Giá Sản Phẩm</h2>
        <div class="general-review">4.0</div>
        <div class="review-rating">
          <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
          <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
          <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
          <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
          <img class="lazyload" data-src="{{url('web/newImage/detail/no-star.svg')}}" alt="">
        </div>
        <span class="count-review">{{$reviews->count()}} Reviews</span>
      </div>
      <div class="reviews">
        @foreach ($reviews as $review)
        <div class="review-item">
          <p class="review-name">{{$review->getUser->name}}</p>
          <div class="review-rating">
            <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
            <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
            <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
            <img class="lazyload" data-src="{{url('web/newImage/detail/star.svg')}}" alt="">
            <img class="lazyload" data-src="{{url('web/newImage/detail/no-star.svg')}}" alt="">
          </div>
          <div class="review-des">{{$review->content}}</div>
          <span class="review-date">{{$review->created_at}}</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<!-- End Product -->
{{ Widget::run('usp') }}
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.3.2/js/lightgallery.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#lightgallery-detail').lightGallery();

    // Active when choose variants
    $(".attribute_group_name").change(function() {
      $(".attribute_group_name, .product_variant_option").removeClass("error_variant");
      const activeGroup = $(this).children(":selected").attr("id");
      $(".attribute_group_name option").removeClass("active");
      $('#' + activeGroup).addClass("active");
      $(".product_variant_option").removeClass("active");
      $('.product_variant_option').children().removeClass('active').removeAttr('selected');
      $("#value_" + activeGroup).addClass("active");
      const activeVaritantOption = $(this).children(":selected").attr("id");
      $("#value_" + activeVaritantOption + ' option:first').attr('selected', true).addClass('active');
      $("#value_" + activeVaritantOption).trigger('change');

      const priceProduct = $(".product-price.active .ga-product-price").attr("data-price");
      const variantProduct = $(".product-price.active .ga-product-price").attr("data-sku");
      $(".js-ga-add-to-cart").attr({
        'data-product-price': priceProduct
        , 'data-product-variant': variantProduct
      });
    });

    $(".product_variant_option").change(function() {
      $(".attribute_group_name, .product_variant_option").removeClass("error_variant");
      $(".product_variant_option").children().removeClass("active");
      $(this).children(":selected").addClass("active").attr('selected', true);
      const variantId = $(this).val();
      const productVariant = $("[name='product_variant']");
      productVariant.val(variantId)
      $(".product-price").removeClass("active");
      $("#price_" + variantId).addClass("active");

      const priceProduct = $(".product-price.active .ga-product-price").attr("data-price");
      const variantProduct = $(".product-price.active .ga-product-price").attr("data-sku");
      $(".js-ga-add-to-cart").attr({
        'data-product-price': priceProduct
        , 'data-product-variant': variantProduct
      });
    });
    // End active when choose variants

    // Open lightbox by id
    $("#main-image-product .carousel-item").click(function() {
      var index = $(this).data("index");
      $(".items-image-" + index).click();
    });
    // End open lightbox by id

    // Add to cart
    $(".add-to-cart").click(function() {
      $("#add-to-cart").submit();
    });
    // End add to cart
    $(".product_variant_option.active").trigger("change");
  });

</script>
@endpush

@if (Session::get('addToCart'))
  @push('scripts')
    <script type="text/javascript">
      $('#cart, .overlay, body').addClass('active');
    </script>
  @endpush
@endif
