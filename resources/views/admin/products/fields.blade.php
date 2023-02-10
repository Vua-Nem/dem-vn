<div class="form-group col-sm-6">
    {!! Form::label('sku', 'Sku:') !!}
    {!! Form::text('sku', null, ['class' => 'form-control','maxlength' => 30,'maxlength' => 30]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Tên:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('price', 'Giá:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('compare_price', 'Giá gốc:') !!}
    {!! Form::number('compare_price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('video_url', 'Video Link:') !!}
    {!! Form::text('video_url', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Loại:') !!}
    <select name="category_id" class="form-control">
        @foreach($categories as $category)
            <option @if(isset($product) && $product->category_id == $category->id) selected
                    @endif value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('brand_id', 'Nhãn hiệu:') !!}
    <select name="brand_id" class="form-control">
        @foreach($brands as $brand)
            <option @if(isset($product) && $product->brand_id == $brand->id) selected
                    @endif value="{{$brand->id}}">{{$brand->name}}</option>
        @endforeach
    </select>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('status', 'Trạng thái:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
    </label>
    <select name="status" class="form-control">
        @foreach(\App\Models\Product::$status as $key => $status)
            <option @if(isset($product) && $product->status == $key) selected
                    @endif value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('default_img', 'Ảnh sản phẩm:') !!}
    <input type="file" multiple name="default_img[]" class="form-control">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', 'Mô tả:') !!}
    <textarea class="form-control" id="ckeditor" name="description">@if(isset($product->description->description)){{$product->description->description}}@endif</textarea>
</div>

<div class="form-group col-sm-6" id="shortDescriptions">
    {!! Form::label('shortDescriptions', 'Mô tả ngắn :') !!}
    @php
        if (isset($product)) {
            $shortDescriptions = old('shortDescriptions') ? old('shortDescriptions') : json_decode($product->shortDescriptions, true);
        }
        else {
            $shortDescriptions = old('shortDescriptions');
        }
    @endphp
    @if (!empty($shortDescriptions))
        <div style="display:none" id="count" data-count="{{count($shortDescriptions)}}"></div>
        @foreach ($shortDescriptions as $key => $shortDescription)
            <div style="display: flex; gap: 10px; margin-bottom: 10px" class="short_description">
                {!! Form::text('shortDescriptions['.$key.'][name]', null, ['class' => 'form-control']) !!}
                @if ($key == 0)
                    <button type="button" name="add" id="add" class="btn btn-outline-primary" style="width: 100px">Thêm mới</button>
                @else
                    <button type="button" name="remove" class="btn btn-outline-danger remove-input-field" class="btn btn-outline-primary" style="width: 100px">Xóa</button>
                @endif
            </div>
        @endforeach
    @else
        <div style="display: flex; gap: 10px; margin-bottom: 10px" class="short_description">
            {!! Form::text('shortDescriptions[0][name]', null, ['class' => 'form-control']) !!}
            <button type="button" name="add" id="add" class="btn btn-outline-primary" style="width: 100px">Thêm mới</button>
        </div>
    @endif
</div>


<div class="form-group col-sm-12">
    {!! Form::submit('Lưu', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('products.index') }}" class="btn btn-default">Hủy</a>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace( 'ckeditor' );
        });
        const countEl = $('#count');
        var i = countEl.length ? countEl.attr('data-count') - 1 : 0;
        $("#add").click(function () {
            ++i;
            $("#shortDescriptions").append('<div style="display: flex; gap: 10px; margin-bottom: 10px" class="short_description"><input class="form-control" name="shortDescriptions['+ i +'][name]" type="text"><button type="button" name="remove" class="btn btn-outline-danger remove-input-field" class="btn btn-outline-primary" style="width: 100px">Xóa</button></div>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('.short_description').remove();
        });
    </script>
@endpush