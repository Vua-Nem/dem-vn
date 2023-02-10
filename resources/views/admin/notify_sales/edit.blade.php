@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Notify Sale
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($notifySale, ['route' => ['notifySales.update', $notifySale->id], 'method' => 'patch']) !!}

                        @include('admin.notify_sales.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection