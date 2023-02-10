<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url Link:') !!}
    {!! Form::text('url', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('default_img', 'Default Img:') !!}
    <input type="file" multiple name="default_img" class="form-control">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('slost', 'Position:') !!}
    {!! Form::text('slost', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'Yes','0' => 'No'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['0' => 'Image','1' => 'Video'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('comment', 'Description:') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
</div>

@if(isset($pageNews->name))
    <div class="form-group col-sm-6">
        <div>
            <label>Page News Image:</label>
        </div>
        <img width="150px"
             src="{{route("showImageFolder", [
             'folder' => 'page_news',
             "fileName" => $pageNews->name,
             "size" => 255,
             "id" => $pageNews->id
             ])}}">
    </div>
@endif

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('pageNews.index') }}" class="btn btn-default">Cancel</a>
</div>
