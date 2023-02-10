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
                MÃ SẢN PHẨM: {{$item->productVariant->sku}}<br><br>
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
            Tạm tính<br>
            Vận chuyển<br>
            <strong>Tổng số</strong>
        </td>
        <td style="padding: 10px;border-left: 1px solid #dbdbdb">
            {{$totalQuantity}}<br>
            0<br>
            {{$totalQuantity}}<br>
        </td>
        <td style="padding: 10px;border-left: 1px solid #dbdbdb">
            {{price($totalAmount)}} đ <br>
            0 đ <br>
            {{price($totalAmount)}} đ <br>
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