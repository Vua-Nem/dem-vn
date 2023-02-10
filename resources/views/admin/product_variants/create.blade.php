@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product Variant
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'productVariants.store']) !!}
                    @include('admin.product_variants.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection