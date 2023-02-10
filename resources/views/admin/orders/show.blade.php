@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-12" style="margin: 20px 0px">
                            <div class="row">
                                <div class="col-md-7">
                                    <form action="" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="orderId" value="{{$order->id}}">
                                        <div class="form-group col-md-7">
                                            <label>Cập nhật trạng thái đơn hàng:</label>
                                            <select id="order_status" name="order_status" class="form-control">
                                                @foreach(\App\Models\Orders::$orderStatus as $key => $name)
                                                    <option @if ($order->order_status == $key) selected @endif
                                                    value="{{$key}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info form-control"
                                                        style="margin-top: 22px;">Cập nhật trạng thái đơn hàng
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-5 pull-right">
                                    @if ($errors->any())
                                        <div class="alert alert-danger" style="margin-bottom: 0px">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="margin-top: 0px">
                        <div style="border-bottom: 1px solid #E6E9ED;">
                            <div class="col-md-6" style="border-right: 1px solid #E6E9ED;padding: 10px">
                                <strong>Thông tin về sản phẩm</strong>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">

                                    <style>
                                        .table > thead > tr > th {
                                            border-bottom: 1px;
                                        }
                                    </style>
                                    <table class="table">
                                        <thead>
                                        <tr style="font-size: 14px">
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                        </tr>
                                        </thead>
                                        <tbody style="margin-top: -1px">
                                        <?php $totalAmount = 0; ?>
                                        @foreach($order->items as $value)
                                            <?php $totalAmount += $value->price_unit; ?>
                                            <tr>

                                                <td style="font-size: 13px">
                                                    <div>
                                                        {{$value->productVariant->name ?? ''}}
                                                    </div>
                                                    <div> SKU:
                                                        <strong class="color_1">
                                                            {{$value->productVariant->sku ?? ''}}
                                                        </strong>
                                                    </div>
                                                    <div>
                                                        Số lượng: <strong>{{$value->quantity}}</strong>
                                                    </div>
                                                </td>
                                                <td style="font-size: 13px">
                                                    <div> Giá:
                                                        <strong class="color_1">
                                                            {{number_format($value->price, 0, ',', '.')}}đ
                                                        </strong>
                                                    </div>

                                                    <div> Giá sau giảm:
                                                        <strong class="color_1">
                                                            {{number_format($value->price - $value->promotion_discount, 0, ',', '.')}}
                                                            đ
                                                        </strong>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="order-infor"
                                         style="margin-top: 30px;border-top: 1px solid #dbdbdb;padding-top: 10px">

                                        <div class="text-right" style="margin-top: 20px">
                                            <div>
                                                <div class="col-md-2 pull-right text-left">
                                                    <strong class="color_1">{{ price($order->real_amount) }}đ </strong>
                                                </div>
                                                <div class="col-md-5 pull-right">
                                                    Giá trị sản phẩm:
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6" style="border-left: 1px solid #E6E9ED;padding-top: 10px">
                                    <table class="table table-bordered">
                                        <tbody style="margin-top: -1px">
                                        <tr>
                                            <td style="font-size: 13px">
                                                Mã đơn hàng
                                            </td>
                                            <td style="font-size: 13px">
                                                {{$order->id}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Trạng thái đơn hàng
                                            </td>
                                            <td style="font-size: 13px">

                                                @if ($order->status == \App\Models\Orders::ORDER_STATUS_IS_PENDING)
                                                    <p class="blue">Đơn hàng mới</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Trạng thái thanh toán
                                            </td>
                                            <td style="font-size: 13px">
                                                @if ($order->payment_status == \App\Models\Orders::ORDER_PAYMENT_STATUS_IS_PENDING)
                                                    <p class="label  btn-warning">Đơn hàng chưa thanh toán</p>
                                                @elseif ($order->payment_status == \App\Models\Orders::ORDER_PAYMENT_STATUS_IS_COMPLETE)
                                                    <p class="label btn-success">Đơn hàng đã thanh toán</p>
                                                @elseif ($order->payment_status == \App\Models\Orders::ORDER_PAYMENT_STATUS_IS_FAILS)
                                                    <p class="label btn-danger">Đơn hàng thất bại</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Hình thức thanh toán
                                            </td>
                                            <td style="font-size: 13px">
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
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Số tiền cần thanh toán
                                            </td>
                                            <td style="font-size: 13px">
                                                <strong class="color_1">
                                                    {{price($order->real_amount)}}đ
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Số tiền thực nhận
                                            </td>
                                            <td style="font-size: 13px">
                                                <strong class="color_1">
                                                    {{price($order->real_amount)}}đ
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Tên người nhận
                                            </td>
                                            <td style="font-size: 13px">
                                                <strong>{{$order->user_name}}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Số Điện thoại
                                            </td>
                                            <td style="font-size: 13px">
                                                <strong>{{phone($order->phone_number)}}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Địa chỉ:
                                            </td>
                                            <td style="font-size: 13px">
                                                @foreach($provinces as $province)
                                                    @if ($order->province_id == $province->id) {{$province->name}} @endif
                                                @endforeach -
                                                @foreach($districts as $district)
                                                    @if ($order->district_id == $district->id) {{$district->name}} @endif
                                                @endforeach
                                                - {{$order->address}}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Ngày tạo
                                            </td>
                                            <td style="font-size: 13px">
                                                {{$order->created_at}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px">
                                                Ghi chú:
                                            </td>
                                            <td style="font-size: 13px">
                                                {{$order->description}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @if ($order->status == \App\Models\Orders::ORDER_STATUS_IS_PENDING)
                                        <div class="col-md-6 pull-right">
                                            <div class="row">
                                                <div class="from-group" style="margin-top: 30px">
                                                    <a href="{{route("admin.order.loadCart", ["orderId" => $order->id])}}" class="form-control btn btn-info">
                                                        Sửa thông tin đơn hàng
                                                    </a>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection