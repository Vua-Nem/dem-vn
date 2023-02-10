<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Title Url -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url Link:') !!}
    {!! Form::text('url', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Title description -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- File upload img -->
<div class="form-group col-sm-6">
    {!! Form::label('default_img', 'Default Img:') !!}
    <input type="file" multiple name="default_img" class="form-control">
</div>


<!-- Slost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slost', 'Slost:') !!}
    {!! Form::text('slost', null, ['class' => 'form-control']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'Yes','0' => 'No'], null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['0' => 'Trang chủ','1' => 'Chi tiết loại sản phẩm'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('type', 'Web And Mobile:') !!}
    <select name="is_mobile" class="form-control">
        <option @if(isset($banner->is_mobile) && $banner->is_mobile == \App\Models\Banner::BANNER_IS_WEBSITE) selected
                @endif value="{{\App\Models\Banner::BANNER_IS_WEBSITE}}">Website
        </option>
        <option @if(isset($banner->is_mobile) && $banner->is_mobile == \App\Models\Banner::BANNER_IS_MOBILE_WEB) selected
                @endif value="{{\App\Models\Banner::BANNER_IS_MOBILE_WEB}}">Mobile
        </option>
    </select>
</div>
@if(!empty($banner->name))
    <div class="form-group col-sm-6">
        <div><label>Banner Image:</label></div>
        @if(!empty($banner->name))
        <img width="150px" src="{{route("showImageBanner", ["fileName" => $banner->name])}}">
        @endif
    </div>
@endif

<div class="form-group col-md-6">
    <label for="from_date">Ngày bắt đầu: </label>
    <input name="time_start" type="text" class="form-control datetimepicker" value="@if(isset($banner->time_start)) {{date("Y/m/d", $banner->time_start)}}@endif">
</div>
<div class="form-group col-md-6 pull-right">
    <label for="to_date">Ngày kết thúc: </label>
    <input name="time_end" type="text" class="form-control datetimepicker " value="@if(isset($banner->time_end)) {{date("Y/m/d", $banner->time_end)}}@endif">
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('banners.index') }}" class="btn btn-default">Cancel</a>
</div>

