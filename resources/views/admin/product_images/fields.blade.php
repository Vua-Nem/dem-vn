<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Sản phẩm:') !!}
    <select name="product_id" class="form-control">
        @foreach($products as $product)
            <option @if(isset($productImage) && $productImage->product_id == $product->id) selected
                @endif value="{{$product->id}}">{{$product->name}}</option>
        @endforeach
    </select>
</div>

<!-- Path Field -->
<div class="form-group col-sm-6">
    {!! Form::label('path', 'Đường dẫn:') !!}
    {!! Form::text('path', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Loại:') !!}
    <select name="type" class="form-control">
        @foreach(\App\Models\ProductImage::$imageType as $key => $type)
            <option @if(isset($productImage) && $productImage->type == $key) selected
                    @endif value="{{$key}}">{{$type}}</option>
        @endforeach
    </select>
</div>


<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Tên:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Lưu', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('productImages.index') }}" class="btn btn-default">Hủy</a>
</div>
