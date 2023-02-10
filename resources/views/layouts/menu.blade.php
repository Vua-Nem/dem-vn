<li class="{{ Request::is('orders*') ? 'active' : '' }}">
  <a href="{{ route('orders.index') }}"><i class="fa fa-edit"></i><span>Đơn hàng</span></a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
  <a href="{{ route('categories.index') }}"><i class="fa fa-edit"></i><span>Loại sản phẩm</span></a>
</li>

<li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
  <a href="{{ route('products.index') }}"><i class="fa fa-edit"></i><span>Sản phẩm</span></a>
</li>

<li class="{{ Request::is('admin/productVariants*') ? 'active' : '' }}">
  <a href="{{ route('productVariants.index') }}"><i class="fa fa-edit"></i><span>Biến thể sản phẩm</span></a>
</li>

<li class="{{ Request::is('admin/productImages*') ? 'active' : '' }}">
  <a href="{{ route('productImages.index') }}"><i class="fa fa-edit"></i><span>Ảnh sản phẩm</span></a>
</li>

<li class="{{ Request::is('admin/attributes*') ? 'active' : '' }}">
  <a href="{{ route('attributes.index') }}"><i class="fa fa-edit"></i><span>Thuộc tính</span></a>
</li>

<li class="{{ Request::is('admin/attributeValues*') ? 'active' : '' }}">
  <a href="{{ route('attributeValues.index') }}"><i class="fa fa-edit"></i><span>Giá trị thuộc tính</span></a>
</li>

<li class="{{ Request::is('admin/productAttributeValues*') ? 'active' : '' }}">
  <a href="{{ route('productAttributeValues.index') }}"><i class="fa fa-edit"></i><span>Giá trị thuộc tính sản phẩm</span></a>
</li>

{{-- <li class="{{ Request::is('productBundles*') ? 'active' : '' }}">
<a href="{{ route('productBundles.index') }}"><i class="fa fa-edit"></i><span>Product Bundles</span></a>
</li> --}}

{{-- <li class="{{ Request::is('admin/tmpProducts*') ? 'active' : '' }}">
<a href="{{ route('tmpProducts.index') }}"><i class="fa fa-edit"></i><span>Tmp Products</span></a>
</li>

<li class="{{ Request::is('admin/vendors*') ? 'active' : '' }}">
  <a href="{{ route('vendors.index') }}"><i class="fa fa-edit"></i><span>Vendors</span></a>
</li> --}}

<li class="{{ Request::is('admin/brands*') ? 'active' : '' }}">
  <a href="{{ route('brands.index') }}"><i class="fa fa-edit"></i><span>Nhãn hiệu</span></a>
</li>


{{-- <li class="{{ Request::is('admin/menus*') ? 'active' : '' }}">
  <a href="{{ route('menus.index') }}"><i class="fa fa-edit"></i><span>Menus</span></a>
</li> --}}
{{--
<li class="{{ Request::is('admin/promotions*') ? 'active' : '' }}">
<a href="{{ route('promotions.index') }}"><i class="fa fa-edit"></i><span>Promotions</span></a>
</li>

<li class="{{ Request::is('admin/promotionObjects*') ? 'active' : '' }}">
  <a href="{{ route('promotionObjects.index') }}"><i class="fa fa-edit"></i><span>Promotion Objects</span></a>
</li>

<li class="{{ Request::is('topProducts*') ? 'active' : '' }}">
  <a href="{{ route('topProducts.index') }}"><i class="fa fa-edit"></i><span>Top Products</span></a>
</li>

<li class="{{ Request::is('provinces*') ? 'active' : '' }}">
  <a href="{{ route('provinces.index') }}"><i class="fa fa-edit"></i><span>Provinces</span></a>
</li>

<li class="{{ Request::is('districts*') ? 'active' : '' }}">
  <a href="{{ route('districts.index') }}"><i class="fa fa-edit"></i><span>Districts</span></a>
</li>
<li class="{{ Request::is('vNPayCallLogs*') ? 'active' : '' }}">
  <a href="{{ route('vNPayCallLogs.index') }}"><i class="fa fa-edit"></i><span>V N Pay Call Logs</span></a>
</li>
<li class="{{ Request::is('payooCallLogs*') ? 'active' : '' }}">
  <a href="{{ route('payooCallLogs.index') }}"><i class="fa fa-edit"></i><span>Payoo Call Logs</span></a>
</li> --}}

{{--<li class="{{ Request::is('partialPaymentFees*') ? 'active' : '' }}">--}}
{{--<a href="{{ route('partialPaymentFees.index') }}"><i class="fa fa-edit"></i><span>Partial Payment Fees</span></a>--}}
{{--</li>--}}

{{-- <li class="{{ Request::is('payooIpnErrorLogs*') ? 'active' : '' }}">
<a href="{{ route('payooIpnErrorLogs.index') }}"><i class="fa fa-edit"></i><span>Payoo Ipn Error Logs</span></a>
</li> --}}

{{-- <li class="{{ Request::is('tinyKeys*') ? 'active' : '' }}">
  <a href="{{ route('tinyKeys.index') }}"><i class="fa fa-edit"></i><span>Tiny Keys</span></a>
</li> --}}

{{-- <li class="{{ Request::is('pageNews*') ? 'active' : '' }}">
  <a href="{{ route('pageNews.index') }}"><i class="fa fa-edit"></i><span>Tin tức</span></a>
</li> --}}

<li class="{{ Request::is('vouchers*') ? 'active' : '' }}">
  <a href="{{ route('vouchers.index') }}"><i class="fa fa-edit"></i><span>Mã giảm giá</span></a>
</li>

<li class="{{ Request::is('orderVouchers*') ? 'active' : '' }}">
  <a href="{{ route('orderVouchers.index') }}"><i class="fa fa-edit"></i><span>Đơn hàng giảm giá</span></a>
</li>

<li class="{{ Request::is('banners*') ? 'active' : '' }}">
  <a href="{{ route('banners.index') }}"><i class="fa fa-edit"></i><span>Banners</span></a>
</li>
<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
  <a href="{{ route('contacts.index') }}"><i class="fa fa-edit"></i><span>Liên hệ</span></a>
</li>
<li class="{{ Request::is('review*') ? 'active' : '' }}">
  <a href="{{ route('reviews.index')}}"><i class="fa fa-edit"></i><span>Đánh giá</span></a>
</li>

{{-- <li class="{{ Request::is('countDowns*') ? 'active' : '' }}">
  <a href="{{ route('countDowns.index') }}"><i class="fa fa-edit"></i><span>Count Downs</span></a>
</li>

<li class="{{ Request::is('notifySales*') ? 'active' : '' }}">
  <a href="{{ route('notifySales.index') }}"><i class="fa fa-edit"></i><span>Notify Sales</span></a>
</li> --}}

{{--
<li class="{{ Request::is('wishLists*') ? 'active' : '' }}">
<a href="{{ route('wishLists.index') }}"><i class="fa fa-edit"></i><span>Wish Lists</span></a>
</li>

<li class="{{ Request::is('seoContents*') ? 'active' : '' }}">
  <a href="{{ route('seoContents.index') }}"><i class="fa fa-edit"></i><span>Seo Contents</span></a>
</li>

<li class="{{ Request::is('retailerAddresses*') ? 'active' : '' }}">
  <a href="{{ route('retailerAddresses.index') }}"><i class="fa fa-edit"></i><span>Retailer Addresses</span></a>
</li> --}}

