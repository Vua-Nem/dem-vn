@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Promotion
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.promotions.show_fields')
                    <a href="{{ route('promotions.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
