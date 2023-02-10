@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Giá trị thuộc tính sản phẩm
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productAttributeValue, ['route' => ['productAttributeValues.update', $productAttributeValue->id], 'method' => 'patch']) !!}

                        @include('admin.product_attribute_values.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection