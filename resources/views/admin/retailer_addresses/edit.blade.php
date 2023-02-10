@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Retailer Address
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($retailerAddress, ['route' => ['retailerAddresses.update', $retailerAddress->id], 'method' => 'patch']) !!}

                        @include('admin.retailer_addresses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       <div>
        <section class="content-header">
            <h1>SEO Content</h1>
        </section>
        <div class="content">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        @if(!empty($seoContent))
                            {!! Form::model($seoContent, ['route' => ['seoContents.update', $seoContent->id], 'method' => 'patch']) !!}
                        @else
                            {!! Form::open(['route' => 'seoContents.store']) !!}
                            {{csrf_field()}}
                        @endif
                        <input type="hidden" name="entity_id" value="{{$retailerAddress->id}}">
                        <input type="hidden" name="entity_type"
                               value="{{ \App\Models\SeoContent::SEO_STORE }}">
                        <div class="form-group col-sm-12">
                            {!! Form::label('meta_title', 'Meta Title:') !!}
                            {!! Form::text('meta_title', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
                        </div>
                        <div class="form-group col-sm-12 col-lg-12">
                            {!! Form::label('meta_keyword', 'Meta Keyword:') !!}
                            {!! Form::text('meta_keyword', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-12 col-lg-12">
                            {!! Form::label('meta_des', 'Meta Des:') !!}
                            {!! Form::textarea('meta_des', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection