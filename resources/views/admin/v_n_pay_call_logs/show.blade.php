@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            V N Pay Call Logs
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.v_n_pay_call_logs.show_fields')
                    <a href="{{ route('vNPayCallLogs.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
