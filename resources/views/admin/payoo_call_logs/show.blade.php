@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Payoo Call Log
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.payoo_call_logs.show_fields')
                    <a href="{{ route('payooCallLogs.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
