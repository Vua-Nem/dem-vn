@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ảnh sản phẩm
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.product_images.show_fields')
                <a href="{{ route('productImages.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection
