@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Giá trị thuộc tính sản phẩm
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.product_attribute_values.show_fields')
                    <a href="{{ route('productAttributeValues.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection
