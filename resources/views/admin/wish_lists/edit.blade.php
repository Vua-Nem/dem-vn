@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Wish List
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($wishList, ['route' => ['wishLists.update', $wishList->id], 'method' => 'patch']) !!}

                        @include('admin.wish_lists.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection