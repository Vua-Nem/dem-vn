@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="content-wrapper">
            <img src="{{url("/web/image/errorpage/img-404.jpg")}}">
            <div class="text">
                <div class="title">LỖI 404</div>
                <div class="desc">Đã có lỗi xảy ra trong quá trình truy cập website dem.vn</div>
                <div class="action">
                    <a href="{{route("home")}}">
                        <i class="fa fa-angle-left" aria-hidden="true"></i> Quay lại trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
#footer, .main-menu, .header-cart {
    display: none;
}

.content-wrapper {
    flex: 0 0 auto;
    width: 100%;
    text-align: center;
    padding-top: 30px;
    padding-bottom: 50px;
}

.content-wrapper .text .title {
    font-size: 20px;
    line-height: 23px;
    color: #EB4A4A;
    margin-top: 10px;
}
.content-wrapper .text .desc {
    font-size: 16px;
    line-height: 19px;
    text-align: center;
    color: #464646;
    margin-top: 10px;
}
.content-wrapper .text .action {
    border: 1px solid #6800BE;
    box-sizing: border-box;
    border-radius: 10px;
    font-size: 16px;
    display: inline-block;
    height: 45px;
    line-height: 45px;
    padding: 0 20px;
    margin-top: 40px;
}
.content-wrapper .text .action a{
    color: #6800BE;
}
</style>
@endsection
