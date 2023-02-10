@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Retailer Addresses</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('retailerAddresses.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                <form class="search-product" action="" method="get">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Product ID</label>
                            <input type="text" value="{{request()->get('name')}}" placeholder="Tên cửa hàng"
                                   name="name"
                                   class="form-control">
                        </div>
                        <div class="col-md-3 pull-right text-right">
                            <button type="submit" class="btn btn-success" style="margin-top: 25px">Tìm kiếm</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.retailer_addresses.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

