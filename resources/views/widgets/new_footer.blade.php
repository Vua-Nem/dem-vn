<div id="footer">
  <div class="footer-top">
    <div class="footer-item">
      <div class="content-col">
        <img class="lazyload logo-footer" data-src="{{url('web/newImage/logo-footer.svg')}}" alt="" />
        <div class="content-row">
          <p>Gọi mua hàng (8h30 - 21:00)</p>
          <div class="item-action">
            <img class="lazyload" data-src="{{url('web/newImage/headphone-footer.svg')}}" alt="" />
            <a href="tel:1800 2095">1800 2095</a>
          </div>
        </div>
        <div class="content-row">
          <p>Gọi khiếu nại (8h30 - 18h00)</p>
          <div class="item-action">
            <img class="lazyload" data-src="{{url('web/newImage/headphone-footer.svg')}}" alt="" />
            <a href="tel:1800 2093">1800 2093</a>
          </div>
        </div>
        <div class="content-row">
          <p>Email</p>
          <div class="item-action">
            <img class="lazyload" data-src="{{url("web/newImage/email.svg")}}" alt="" />
            <a href="mailto:cskh@dem.vn">cskh@dem.vn</a>
          </div>
        </div>
        <div class="bocongthuong">
          <a href="#">
            <img class="lazyload" data-src="{{url("web/newImage/bocongthuong.svg")}}" alt="" />
          </a>
        </div>
      </div>
      <div class="content-col">
        <div class="title">Sản phẩm</div>
        @foreach ($categories as $category)
          <div class="content-row">
            <a href="{{route('category.detail', $category->slug)}}">{{$category->name}}</a>
          </div>
        @endforeach
      </div>
    </div>
    <div class="footer-item">
      <div class="content-col">
        <div class="title">Chính sách</div>
        <div class="content-row">
          <a href="#">Chương trình ngủ thử 180 đêm</a>
        </div>
        <div class="content-row">
          <a href="#">Điều khoản & Điều kiện</a>
        </div>
        <div class="content-row">
          <a href="#">Phương thức thanh toán</a>
        </div>
        <div class="content-row">
          <a href="#">Chính sách vận chuyển<br />
            & giao nhận</a>
        </div>
        <div class="content-row">
          <a href="#">Chính sách bảo hành</a>
        </div>
        <div class="content-row">
          <a href="#">Chính sách bảo mật</a>
        </div>
      </div>
      <div class="content-col">
        <div class="title">Kết nối với chúng tôi</div>
        <div class="socials">
          <a href="https://www.facebook.com/dem.vn/" target="_blank"><img class="lazyload" data-src="{{url("web/newImage/facebook.svg")}}" alt="" /></a>
          <a href="#" target="_blank"><img class="lazyload" data-src="{{url("web/newImage/instagram.svg")}}" alt="" /></a>
          <a href="#" target="_blank"><img class="lazyload" data-src="{{url("web/newImage/youtube.svg")}}" alt="" /></a>
        </div>
        <div class="logo-payments">
          <img data-src="{{url("web/newImage/detail/ic-payment-all.svg")}}" alt="list payment" class="lazyload">
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2022 - Bản quyền của Dem.vn</span>
    <span>Mã số doanh nghiệp 0107968516 do Sở Kế hoạch Đầu tư Hà Nội cấp lần 1 ngày 18/8/2017</span>
  </div>
  <!-- End Footer -->
</div>
