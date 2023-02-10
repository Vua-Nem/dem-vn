@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Product</h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($product, ["id" => "productEdit", 'route' => ['products.update', $product->id], 'method' => 'patch', "enctype" => "multipart/form-data"]) !!}
                    @include('admin.products.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div>
        <section class="content-header">
            <h1>SEO Content</h1>
        </section>
        <div class="content">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        @if(!empty($seoContent))
                            {!! Form::model($seoContent, ['route' => ['seoContents.update', $seoContent->id], 'method' => 'patch']) !!}
                        @else
                            {!! Form::open(['route' => 'seoContents.store']) !!}
                            {{csrf_field()}}
                        @endif
                        <input type="hidden" name="entity_id" value="{{$product->id}}">
                        <input type="hidden" name="entity_type"
                               value="{{ \App\Models\SeoContent::SEO_PRODUCT }}">
                        <div class="form-group col-sm-12">
                            {!! Form::label('meta_title', 'Meta Title:') !!}
                            {!! Form::text('meta_title', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
                        </div>
                        <div class="form-group col-sm-12 col-lg-12">
                            {!! Form::label('meta_keyword', 'Meta Keyword:') !!}
                            {!! Form::text('meta_keyword', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-12 col-lg-12">
                            {!! Form::label('meta_des', 'Meta Des:') !!}
                            {!! Form::textarea('meta_des', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1>Product Images</h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div style="margin-top: 20px;">
                    @foreach($product->images as $image)
                        <div style="float:left;margin-right:5px;position: relative">
                            <img width="150px"
                                 src="{{route("productImageShow", ["id" => $image->product_id, "size"=>609, "fileName" => $image->name])}}">
                            <div style="position: absolute; top: 0px; right: 0px">
                                {!! Form::open(['route' => ['productImages.destroy', $image->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1 class="pull-left">Product Variant</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-bottom: 5px" href="{{ route('productVariants.create') }}?product_id={{$product->id}}">Add New</a>
        </h1>
        <div class="clearfix"></div>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                @include('admin.products.table_variant')
            </div>
        </div>
    </div>
@endsection