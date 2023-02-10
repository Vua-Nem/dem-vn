@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Orders</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{{ route('orders.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-12">
                    <form action="" method="get">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Từ ngày:</label>
                                <input autocomplete="off" type="text" name="time_start"
                                       class="form-control datetimepicker1"
                                       value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Đến ngày:</label>
                                <input autocomplete="off" type="text" name="time_end"
                                       class="form-control datetimepicker1"
                                       value="">
                            </div>
                        </div>
                        <div class="col-md-3 pull-right text-right">
                            <button style="margin-top: 25px" type="submit" class="btn btn-info ">Tìm kiếm</button>
                        </div>
                    </form>
                </div>

                <div class="clearfix"></div>
                <br>
                <br>
                <br>
                <div class="col-md-12">
                    <div class="row">
                        <style>
                            .table > thead > tr > th {
                                border-bottom: 1px;
                            }
                        </style>
                        <table class="table table-bordered">
                            <thead>
                            <tr style="font-size: 14px">
                                <th>ID</th>
                                <th>Thông tin đơn hàng</th>
                                <th>Thông tin giao hàng</th>
                                <th>Danh sách sản phẩm</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Hình thức thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody style="margin-top: -1px">
                            <?php $totalAmount = 0; ?>
                            @foreach($orders as $order)
                                <tr>
                                    <td style="font-size: 13px">{{$order->id}}</td>
                                    <td style="font-size: 13px">
                                        <p>
                                            Giá trị đơn hàng:
                                            <strong>
                                                {{price($order->amount)}}đ
                                            </strong>
                                        </p>
                                        @if(!empty($order->OrderVoucher))
                                            <p>Mã giảm giá:
                                                <strong>- {{price($order->OrderVoucher->voucher_discount_value)}}
                                                    đ</strong></p>
                                        @endif
                                        <p>Số tiền thực nhận: <strong>{{price($order->real_amount)}}đ</strong></p>
                                        @if (!empty($order->orderReturn) && in_array($order->orderReturn->status, [\App\Models\OrderReturn::ORDER_RETURN_STATUS_COMPLETE, \App\Models\OrderReturn::ORDER_RETURN_STATUS_NEW]))
                                            <p>
                                                Giá trị hàng hoàn:
                                                <strong>
                                                    {{price($order->orderReturn->totalAmount)}}đ
                                                </strong>
                                            </p>
                                            <p>
                                                Tổng tiền thực tế:
                                                <strong class="color_1"> {{price($order->amount_receive - $order->orderReturn->totalAmount)}}
                                                    đ</strong>
                                            </p>
                                        @endif
                                        @if (isset($order->orderCoupon->coupon->value))
                                            <p>
                                                Mã giảm giá:
                                                <strong class="color_1">
                                                    {{price($order->orderCoupon->coupon->value)}}đ
                                                </strong>
                                            </p>
                                        @endif
                                        <p></p>
                                        <p>Phí ship: {{price($order->fee)}}đ</p>
                                        <p>Ngày tạo: {{$order->created_at}}</p>

                                        @if ($order->order_status == \App\Models\Orders::ORDER_STATUS_IS_PENDING)
                                            <p class="blue">Đơn hàng mới</p>
                                        @endif
                                    </td>
                                    <td style="font-size: 13px">
                                        <p>Mã vận đơn: {{$order->delivery_code}}</p>
                                        <p>Tên người nhận: {{$order->user_name}}</p>
                                        <p>Điện thoại: <strong class="color_1">{{phone($order->phone_number)}}</strong>
                                        </p>
                                        <p>Địa chỉ: {{ $order->address }}</p>
                                    </td>
                                    <td style="font-size: 13px">
                                        @foreach($order->items as $item)
                                            <div style="margin-bottom: 10px">
                                                <div>
                                                    [SKU: @if(isset($item->productVariant->sku)){{$item->productVariant->sku}}@endif
                                                    ] @if (isset($item->productVariant->name)){{limit_text($item->productVariant->name, 50)}}@endif</div>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($order->payment_status == \App\Models\Orders::ORDER_PAYMENT_STATUS_IS_PENDING)
                                            <p class="label  btn-warning">Đơn hàng chưa thanh toán</p>
                                        @elseif ($order->payment_status == \App\Models\Orders::ORDER_PAYMENT_STATUS_IS_COMPLETE)
                                            <p class="label btn-success">Đơn hàng đã thanh toán</p>
                                        @elseif ($order->payment_status == \App\Models\Orders::ORDER_PAYMENT_STATUS_IS_FAILS)
                                            <p class="label btn-danger">Đơn hàng thất bại</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->payment_method == \App\Models\Orders::ORDER_PAYMENT_METHOD_IS_COD)
                                            <p class="label  btn-warning">Thanh toán COD</p>
                                        @elseif ($order->payment_method == \App\Models\Orders::ORDER_PAYMENT_METHOD_IS_VNP)
                                            <p class="label btn-primary">Thanh toán qua VNP</p>
                                        @elseif ($order->payment_method == \App\Models\Orders::ORDER_PAYMENT_METHOD_IS_PAYOO)
                                            <p class="label btn-danger">Thanh toán qua PAYOO</p>
                                        @else
                                            <p class="label btn-info">Thanh toán qua Chuyển khoản</p>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a style="width: 100%" class="btn-sm btn btn-default "
                                               href="{{route('orders.show', ['order' => $order->id])}}">
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
            {{ $orders->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
		$(document).ready(function () {
			$('.datetimepicker1').datetimepicker({
				format: 'YYYY-MM-DD 00:00:00'
			});
		})
    </script>
@endsection


