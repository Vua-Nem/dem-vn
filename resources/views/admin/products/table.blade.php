<div class="table">
    <table class="table" id="products-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Sku</th>
            <th>Tên</th>
            <th>Nhãn hiệu</th>
            <th>Loại</th>
            <th>Mô tả ngắn</th>
            <th>Hàng tồn kho</th>
            <th>Trạng thái</th>
            {{-- <th>Count down</th>
            <th>Notify Sale</th> --}}
            <th colspan="3">Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)

            <?php
            $vQty = 0;
            foreach ($product->variants as $variant) {
                $vQty += $variant->qty;
            }
            ?>
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->sku }}</td>
                <td>
                    {{ $product->name }} -
                    <a href="{{route("product.detail", ["slug" => $product->slug])}}" target="_blank">
                        Link Website
                    </a>
                </td>
                <td>{{ $product->brand->name }}</td>
                <td>{{ $product->category ? $product->category->name : '' }}</td>
                <td>
                    @foreach ($product->shortDescriptions as $shortDescription)
                        <div>
                            {{$shortDescription->name}}
                        </div>
                    @endforeach
                </td>
                <td @if($vQty == 0) style="color: red;"@endif>{{$vQty}} in stock for {{ $product->variants->count() }}
                    variants
                </td>
                <td>{{\App\Models\Product::$status[$product->status]}}</td>
                {{-- <td>
                    <a class='btn btn-success btn-xs' href="{{ route('count_down_product',['entity_id'=>$product->id, 'entity_type'=>\App\Models\CountDown::COUNT_DOWN_PRODUCT]) }}">
                        count down
                    </a>
                </td>
                <td>
                    <a class='btn btn-success btn-xs' href="{{ route('notify_sale_product',['id'=>$product->id]) }}">
                        notify sale
                    </a>
                </td> --}}
                <td>
                    {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('products.edit', [$product->id]) }}"
                           class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div>
        {{ $products->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
