

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Tên cửa hàng', 'Tên cửa hàng:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('postcode', 'Postcode:') !!}
    {!! Form::text('postcode', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Latitude Field -->
<div class="form-group col-sm-6">
    {!! Form::label('latitude', 'Latitude:') !!}
    {!! Form::text('latitude', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Longitude Field -->
<div class="form-group col-sm-6">
    {!! Form::label('longitude', 'Longitude:') !!}
    {!! Form::text('longitude', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Phone Store Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_store', 'Phone Store:') !!}
    {!! Form::text('phone_store', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Extension Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('extension_number', 'Extension Number:') !!}
    {!! Form::text('extension_number', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Province Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('province_id', 'Province Id:') !!}
    <select name="province_id" class="form-control" id="province_id">
        @foreach($provinces as $province)
            <option @if(isset($retailerAddress) && $retailerAddress->province_id == $province->id) selected @endif value="{{$province->id}}">{{$province->name}}</option>
        @endforeach
    </select>
</div>

<!-- District Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district_id', 'District Id:') !!}
    <select name="district_id" class="form-control" id="district_id" >
        @foreach($districts as $districts)
            <option @if(isset($retailerAddress) && $retailerAddress->district_id == $districts->id) selected @endif value="{{$districts->id}}">{{$districts->name}}</option>
        @endforeach
    </select>
    {{--<select name="district_id" class="form-control" ></select>--}}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'Enable','0' => 'Disable'], null, ['class' => 'form-control']) !!}
</div>


<!-- Opening Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opening_time', 'Opening Time:') !!}
    {!! Form::text('opening_time', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('retailerAddresses.index') }}" class="btn btn-default">Cancel</a>
</div>
