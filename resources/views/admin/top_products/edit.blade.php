@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Top Product
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($topProduct, ['route' => ['topProducts.update', $topProduct->id], 'method' => 'patch']) !!}

                        @include('admin.top_products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection