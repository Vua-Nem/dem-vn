@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            V N Pay Call Logs
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($vNPayCallLogs, ['route' => ['vNPayCallLogs.update', $vNPayCallLogs->id], 'method' => 'patch']) !!}

                        @include('admin.v_n_pay_call_logs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection