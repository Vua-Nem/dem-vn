@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ảnh sản phẩm
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productImage, ['route' => ['productImages.update', $productImage->id], 'method' => 'patch']) !!}

                        @include('admin.product_images.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection