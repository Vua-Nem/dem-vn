@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product Bundles
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'productBundles.store']) !!}

                        @include('admin.product_bundles.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
