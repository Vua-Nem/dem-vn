@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Payoo Ipn Error Log
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($payooIpnErrorLog, ['route' => ['payooIpnErrorLogs.update', $payooIpnErrorLog->id], 'method' => 'patch']) !!}

                        @include('admin.payoo_ipn_error_logs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection