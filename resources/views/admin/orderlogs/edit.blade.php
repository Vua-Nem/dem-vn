@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Orderlog
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderlog, ['route' => ['orderlogs.update', $orderlog->id], 'method' => 'patch']) !!}

                        @include('admin.orderlogs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection