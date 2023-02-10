@if($data->count())
<?php $i = 0; ?>
@foreach($data as $val)
	<div class="product-items-pr">
		<input type="radio" name="product_variant_attach" value="{{$val->id}}" @if($i == 0)checked="checked"@endif>
		<div class="image">
            <img class="image-thumbs lazyload"
                 data-src="{{route("showImage", [
                 "entity" => "products",
                 "size" => 105,
                 "id" => $val->product->id,
                 "fileName" => $val->product->images->first()->name ?? "default.jpg"
                 ])}}">
		</div>
		<div class="pr-content">
		     <h4>{{$val->product->name}} x {{$productBundles[$val->sku]["quantity_number"] ?? ''}}</h4>
		    <span class="underline">{{number_format($val->price, 0, '.',',')}}đ </span> <span class="normal">{{number_format($productBundles[$val->sku]["product_attach_price"], 0, '.',',')}}đ</span>
		</div>
	</div>
	<?php $i++ ?>
@endforeach
<style type="text/css">
	.content-sale{margin-bottom: 10px;}
	.sale-products{display: block!important}
	.product-items-pr {display: flex; background: linear-gradient(180deg, rgba(247, 244, 255, 0) 11.94%, #F7F4FF 77.28%);border: 1px solid #F6EBFF;box-sizing: border-box;    padding: 12px 10px 12px 40px;align-items: center;border-radius: 4px;    position: relative;
		margin-bottom: 15px;
	}
	.product-items-pr .image img{max-width: 80px;}
	.product-items-pr .image{width: 80px}
	.pr-content{width: calc(100% - 100px);padding-left: 10px;}
	.pr-content h4{color: #000F40;font-size: 16px;font-weight: 600;    margin-bottom: 4px;}
	.pr-content span.underline{color: #8D8D8D;font-size: 14px; font-weight: normal;   text-decoration: line-through;}

	.pr-content span.normal{color: #0B8A00;font-size: 14px;margin-left: 6px; font-weight: normal; }
	.product-items-pr > input{background-image: url({{url("web/image/icon-check.png")}});    width: 24px;margin-right:10px;
    background-repeat: no-repeat;    -webkit-appearance: none;    position: absolute;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
    left: 0;
    background-position: 8px center;}
.product-items-pr > input:checked {background-image: url({{url("web/image/icon-checked.svg")}});}
</style>
@endif