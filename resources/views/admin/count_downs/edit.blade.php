@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Count Down
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($countDown, ['route' => ['countDowns.update', $countDown->id], 'method' => 'patch']) !!}

                        @include('admin.count_downs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection