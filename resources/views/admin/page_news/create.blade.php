@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Page  News
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'pageNews.store',"enctype" => "multipart/form-data"]) !!}

                        @include('admin.page_news.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
