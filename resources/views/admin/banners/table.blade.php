<div class="table-responsive">
    <div class="col-md-12">
        <form action="" method="get">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Từ ngày:</label>
                    <input autocomplete="off" type="text" name="date_start"
                           class="form-control datetimepicker"
                           value="">
                </div>
                <div class="form-group">
                    <label>Đến ngày:</label>
                    <input autocomplete="off" type="text" name="date_end"
                           class="form-control datetimepicker"
                           value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status:</label>
                    {!! Form::select('status',array(''=>'Tất cả',\App\Models\Banner::BANNER_IS_ACTIVE => "Active",\App\Models\Banner::BANNER_IS_NOT_ACTIVE => "Deactive"),Request::input('status'),array('class'=>'form-control')) !!}
                </div>
                <div class="form-group">
                    <label>Type:</label>
                    {!! Form::select('type',array(''=>'Tất cả',\App\Models\Banner::BANNER_CATEGORY_DETAIL => "Chi tiết loại sản phẩm",\App\Models\Banner::BANNER_HOME => "Trang chủ"),Request::input('type'),array('class'=>'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Hiển thị:</label>
                    {!! Form::select('is_mobile',array(''=>'Tất cả',\App\Models\Banner::BANNER_IS_WEBSITE => "Website",\App\Models\Banner::BANNER_IS_MOBILE_WEB => "Mobile"),Request::input('is_mobile'),array('class'=>'form-control')) !!}
                </div>
            </div>

            <div class="col-md-3 pull-left text-left">
                <button style="margin-top: 25px" type="submit" class="btn btn-info ">Tìm kiếm</button>
            </div>
        </form>
    </div>
    <table class="table" id="banners-table">
        <thead>
        <tr>
            <th>Banner Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Url Link</th>
            <th>Slost</th>
            <th>Status</th>
            <th>Type</th>
            <th>View</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($banners as $banner)
            <tr>
                <td>
                    @if(!empty($banner->name))
                        <img width="150px" src="{{route("showImageBanner", ["fileName" => $banner->name])}}">
                    @endif
                </td>
                <td>{{ $banner->title }}</td>
                <td>{{ $banner->description}}</td>
                <td>{{ $banner->url}}</td>
                <td>{{ $banner->slost }}</td>
                <td>@if($banner->status==1) <label class="label label-info confirm_approval">{!! 'Active' !!}</label>
                    @elseif($banner->status==0) <label
                                class="label label-danger confirm_approval">{!! 'DeActive' !!}</label>
                    @endif
                    <div class="inlineEdit">
                        <select name="confirm" id="confirm_{{$banner->id}}" class="form-control control-xs">
                            <option value="1">Active</option>
                            <option value="0">DeActive</option>
                        </select>
                        <p>
                            <button name="btn_update" type="button" onclick="update_status(this.id)"
                                    id="{{$banner->id}}" class="btn btn-xs approval_update">Update
                            </button>
                            &nbsp;&nbsp;
                            <button class="btn btn-xs approval_cancel" name="btn_cancel" type="button">Cancel</button>
                        </p>
                    </div>
                </td>
                <td>
                    @if($banner->type == 0) {{"Trang chủ"}}  @endif
                    @if($banner->type == 1) {{"Chi tiết loại sản phẩm"}} @endif
                </td>
                <td>
                    @if($banner->is_mobile ==  \App\Models\Banner::BANNER_IS_MOBILE_WEB) {{"Mobile"}}  @endif
                    @if($banner->is_mobile == \App\Models\Banner::BANNER_IS_WEBSITE) {{"Web"}} @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['banners.destroy', $banner->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('banners.show', [$banner->id]) }}" class='btn btn-default btn-xs'>
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                        <a href="{{ route('banners.edit', [$banner->id]) }}" class='btn btn-default btn-xs'>
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $banners->links('vendor.pagination.bootstrap-4') }}
</div>
<style>
    #confirm_5 {
        width: 42%;
        height: 10%;
        margin: 10px 0px;
    }

    .inlineEdit {
        display: none
    }
</style>


