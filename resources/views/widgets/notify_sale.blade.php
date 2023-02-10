@if(!empty($content))
<div class="image">
    <img src="{{url("/web/image/sale.png")}}">
</div>
<div class="content-sale">{!!$content->notify_des!!}</div>
<style type="text/css">
    .sale-products {
        display: block !important
    }
</style>
@endif