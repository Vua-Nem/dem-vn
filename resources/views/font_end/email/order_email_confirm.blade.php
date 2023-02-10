Thân gửi <strong>{{$userName}}</strong>,<br>
Cảm ơn bạn đã đặt hàng tại <a
        href="https://dem.vn">Dem.vn</a> . Đơn hàng của bạn đã được tạo thành công. Chúng tôi sẽ liên hệ xác nhận lịch giao hàng.
<br>
<br>
Đơn đặt hàng của bạn: [#{{$id}}]<br>
Đặt hàng lúc {{date("H:i:s", strtotime($order->created_at))}} Ngày {{date("d", strtotime($order->created_at))}} Tháng {{date("m", strtotime($order->created_at))}} Năm {{date("Y", strtotime($order->created_at))}}
<br>
<br>
<table>
    <tbody>
    <tr>
        <td width="300px">
            Thông tin thanh toán<br>
            <strong>{{$userName}}</strong><br>
            <strong>{{$order->address}}</strong><br>
            <strong>{{$order->district->name}}, {{$order->province->name}}</strong><br>
            <strong>Việt Nam</strong>
        </td>
        <td width="300px">
            Thông tin vận chuyển<br>
            <strong>{{$userName}}</strong><br>
            <strong>{{$order->address}}</strong><br>
            <strong>{{$order->district->name}}, {{$order->province->name}}</strong><br>
            <strong>Việt Nam</strong>
        </td>
    </tr>
    </tbody>
</table>
<br>
<br>
<table>
    <tbody>
    <tr>
        <td width="300px">
            Phương thức thanh toán
            <br>
            <strong>{{\App\Models\Orders::$paymentMethod[$order->payment_method]}}</strong>
        </td>
        <td width="300px">
            Phương thức vận chuyển
            <br>
            Giao hàng Tận nơi
        </td>
    </tr>
    </tbody>
</table>
<br>
<br>
<table style="border: 1px solid #dbdbdb">
    <tbody>
    <tr>
        <td width="300px" style="padding: 10px; border-bottom: 1px solid #dbdbdb">
            <strong>Sản phẩm</strong>
        </td>
        <td style="padding: 10px; border-bottom: 1px solid #dbdbdb; border-left: 1px solid #dbdbdb">
            <strong>Số lượng</strong>
        </td>
        <td style="padding: 10px; border-bottom: 1px solid #dbdbdb; border-left: 1px solid #dbdbdb">
            <strong>Giá</strong>
        </td>
    </tr>
    <?php
    $totalAmount = $totalQuantity = 0;
    ?>
    @foreach($items as $item)
        <tr>
            <td width="300px" style="padding: 10px;border-bottom: 1px solid #dbdbdb">
                Tên sản phẩm <br>
                {{$item->productVariant->sku}} - {{$item->productVariant->name}}<br><br>
                @if(isset($item->productVariant->productAttributeValue))
                    @foreach($item->productVariant->productAttributeValue as $val)
                        {{$val->attributeValue->attribute->name}}<br>
                        {{$val->attributeValue->value}}<br><br>
                    @endforeach
                @endif
            </td>
            <td style="padding: 10px;border-left: 1px solid #dbdbdb;border-bottom: 1px solid #dbdbdb">
                {{$item->quantity}}
            </td>
            <td style="padding: 10px;border-left: 1px solid #dbdbdb;border-bottom: 1px solid #dbdbdb">
                {{price($item->price - $item->promotion_discount)}} đ
            </td>
            <?php
            $totalAmount += (($item->price - $item->promotion_discount) * $item->quantity);
            $totalQuantity += $item->quantity;
            ?>
        </tr>
    @endforeach
    <tr>
        <td width="300px" style="padding: 10px" align="right">
            Tạm tính
        </td>
        <td style="padding: 10px;border-left: 1px solid #dbdbdb">
            {{$totalQuantity}}
        </td>
        <td style="padding: 10px;border-left: 1px solid #dbdbdb">
            {{price($totalAmount)}} đ
        </td>
    </tr>
    <tr>
        <td width="300px" style="padding: 10px" align="right">
            Vận chuyển
        </td>
        <td style="padding: 10px;border-left: 1px solid #dbdbdb">
            0
        </td>
        <td style="padding: 10px;border-left: 1px solid #dbdbdb">
            0 đ
        </td>
    </tr>
    @if($vouchers->count())
    @foreach($vouchers as $voucher)
        <tr>
            <td width="300px" style="padding: 10px" align="right">
                Voucher
            </td>
            <td style="padding: 10px;border-left: 1px solid #dbdbdb">
                1
            </td>
            <td style="padding: 10px;border-left: 1px solid #dbdbdb">
                - {{price($voucher->voucher_discount_value)}} đ
            </td>
        </tr>
    @endforeach
    @endif
    <tr>
        <td width="300px" style="padding: 10px" align="right">
            Tổng số
        </td>
        <td style="padding: 10px;border-left: 1px solid #dbdbdb">
            {{$totalQuantity}}
        </td>
        <td style="padding: 10px;border-left: 1px solid #dbdbdb">
            {{price($order->real_amount)}} đ
        </td>
    </tr>
    </tbody>
</table>
<br>
<br>
<br>
<strong>
    Dem.vn - Website thương mại điện tử về mua sắm online đệm và phụ kiện
</strong>
Hotline: <a href="tel:19002095">1900 2095</a> <br>
Email: cskh@dem.vn<br>
Website: <a href="https://www.dem.vn">www.dem.vn</a>