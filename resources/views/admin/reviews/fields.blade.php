<!-- Title Field -->

<div class="form-group col-sm-6" >
    {!! Form::label('entity_id', 'Entity type:') !!}
    <select class="form-control" name="entity_type" id="">
        <option value="1">Product</option>
    </select>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('entity_id', 'Entity:') !!}
    <select class="form-control" value="{{ isset($review) ? $review->getProduct->id: "" }}" name="entity_id" id="">
    @foreach ($products as $product)
        <option value="{{ $product->id }}" {{  isset($review) && $product->id == $review->getProduct->id? "selected": ""}}>{{ $product->name }}</option>
    @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('status', 'status:') !!}
    <select class="form-control" value="{{ isset($review) ? $review->status : "" }}" name="status" id="">    
        <option value="1">Enable</option>
        <option value="0">Disable</option>
    </select>
</div>
<div class="form-group col-sm-6">
    <label for="user">User</label>
    <input class="form-control" value="{{ isset($review) ? $review->getUser->name : ""}}" type="text" name="name">
</div>
<div class="form-group col-sm-6">
    {!! Form::label('default_img', 'Default Img:') !!}
    <input type="file" multiple name="default_img" class="form-control">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('content', 'content:') !!}
    <input class="form-control"  value="{{ isset($review) ? $review->content : "" }}" name="content">
</div>
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('reviews.index') }}" class="btn btn-default">Cancel</a>
</div>

