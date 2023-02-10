@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Tạo đơn hàng</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-12" style="margin: 20px 0px">
                            <div class="col-md-4">
                                <form action="{{route("addCart")}}" method="post" style="margin-bottom: 0px">
                                    {!! csrf_field() !!}
                                    <div class="from-group">
                                        <label>Nhập mã SKU:</label>
                                        <input type="text" name="sku" autofocus class="form-control" value=""
                                               placeholder="Nhập mã SKU">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 pull-right">
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
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="margin-top: 0px">
                        <form id="createOrder" action="{{route("saveCart")}}" method="post">
                            {!! csrf_field() !!}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <label> Hình thức thanh toán:</label>
                                            <select name="payment_method" class="form-control">
                                                <option value="1">Tiền mặt</option>
                                                <option value="2">Chuyển Khoản</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Trạng thái giao dịch:</label>
                                            <select name="payment_status" class="form-control">
                                                <option value="1">Chờ thanh toán</option>
                                                <option value="2">Đã thanh toán</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> Số tiền thực nhận:</label>
                                            <input name="real_amount" class="form-control" value="">
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>
                                        <br>
                                        <div class="form-group col-md-3">
                                            <label>Họ và Tên khác hàng</label>
                                            <input type="text" class="form-control" name="user_name" value="">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label> Số điện thoại</label>
                                            <input type="text" class="form-control" name="phone_number" value="">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="province"> Tỉnh thành/Thành phố:</label>
                                            <select id="province" name="province_id" class="form-control">
                                                <option value="0">Chọn Tỉnh/Thành phố</option>
                                                @foreach($provinces as $key => $province)
                                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label> Quận/Huyện:</label>
                                            <select id="district" name="district_id" class="form-control">
                                                <option value="0">Chọn quận huyện</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Địa chỉ:</label>
                                            <textarea class="form-control" name="address"
                                                      placeholder="Địa chỉ: Số nhà - Đường - Xã - Phường - Thị trấn"></textarea>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Ghi chú:</label>
                                            <textarea autocomplete="off" class="form-control" name="note"
                                                      placeholder="Ví Dụ: Giảm 50k do su dung voucher"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <div style="border-bottom: 1px solid #E6E9ED;margin-bottom: 20px;">
                                    <div class="col-md-12" style="border-right: 1px solid #E6E9ED;padding: 10px">
                                        <strong>Thông tin về sản phẩm</strong>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div>
                                            <style>
                                                .table > thead > tr > th {
                                                    border-bottom: 1px;
                                                }
                                            </style>
                                            <table class="table" style="font-size: 13px">
                                                <thead>
                                                <tr style="font-size: 14px">
                                                    <th>Ảnh</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Giá sau giảm</th>
                                                    <th>Số lượng</th>
                                                    <th>Tồn kho</th>
                                                    <th>Hành động</th>
                                                </tr>
                                                </thead>
                                                <tbody style="margin-top: -1px">
                                                <?php $totalAmount = 0; ?>
                                                <?php foreach(Cart::content() as $value) :?>
                                                <?php $totalAmount += ($value->price * $value->qty); ?>
                                                <tr>
                                                    <td>
                                                        <img src="{{$value->options->avatar}}"
                                                             style="width:80px !important;">
                                                    </td>
                                                    <td style="font-size: 13px">
                                                        {{$value->name}}
                                                    </td>

                                                    <td>
                                                        <strong class="color_1">
                                                            {{number_format($value->price, 0, ',', '.')}}đ
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        {{number_format($value->price - $value->options->promotion_discount, 0, ',', '.')}}
                                                        đ
                                                    </td>
                                                    <td>
                                                        {{$value->qty}}
                                                    </td>
                                                    <td>
                                                        {{$value->options->inStock}}
                                                    </td>
                                                    <td style="font-size: 13px">
                                                        <a class="btn btn-default"
                                                           href="{{route('removerCartItem', ['id' => $value->rowId])}}">
                                                            <small>Xóa sản phẩm</small>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach;?>
                                                </tbody>
                                            </table>
                                            <div class="order-infor"
                                                 style="margin-top: 30px;border-top: 1px solid #dbdbdb;padding-top: 10px">
                                                <div class="text-right" style="font-size: 15px">Tổng giá trị hàng hóa:
                                                    <strong class="color_1">
                                                        {{number_format($totalAmount, 0, ',', '.')}}đ
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 pull-right">
                                    <div class="row">
                                        <div class="from-group" style="margin-top: 30px">
                                            <button class="form-control btn btn-info" type="submit">Hoàn thành</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#province').on('change', function () {
                    var url = '{{route('ajax.getDistrict')}}';
                    $.get(url + '?id=' + $(this).val(), function (data, status) {
                        $("#district").html(data);
                    });
                });

                $("#createOrder").on('submit', function (event) {
                    return confirm("Bạn có thật sự muốn tạo đơn hàng. Bấm Ok để tiếp tục");
                });
            });
        </script>
    @endpush
@endsection