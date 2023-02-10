@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Landing Contact Form
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($landingContactForm, ['route' => ['landingContactForms.update', $landingContactForm->id], 'method' => 'patch']) !!}

                        @include('admin.landing_contact_forms.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection