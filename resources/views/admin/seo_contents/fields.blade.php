<!-- Entity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_id', 'Entity Id:') !!}

    @if(isset($entity_id))
        {!! Form::number('entity_id',$entity_id, ['class' => 'form-control' ,'readonly']) !!}
    @else
        {!! Form::number('entity_id', null, ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Entity Type Field -->
<div class="form-group col-sm-6 pull-left">
    {!! Form::label('entity_type', 'Entity Type:') !!}
    <select name="entity_type" class="form-control">
        @foreach(\App\Models\SeoContent::$arry_seo_type as $key => $val)
            <option @if(request()->get('entity_type') == $key) selected @endif value="{{$key}}">{{$val}}</option>
        @endforeach
    </select>

</div>


<!-- Meta Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('meta_title', 'Meta Title:') !!}
    {!! Form::text('meta_title', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Meta Keyword Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meta_keyword', 'Meta Keyword:') !!}
    {!! Form::textarea('meta_keyword', null, ['class' => 'form-control']) !!}
</div>

<!-- Meta Des Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meta_des', 'Meta Des:') !!}
    {!! Form::textarea('meta_des', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('seoContents.index') }}" class="btn btn-default">Cancel</a>
</div>
