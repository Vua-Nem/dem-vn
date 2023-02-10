@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Attribute
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($attribute, ['route' => ['attributes.update', $attribute->id], 'method' => 'patch']) !!}

                        @include('admin.attributes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection