<!-- user Field -->
<div class="form-group">
    {!! Form::label('user', 'User:') !!}
    <p>{{ $review->getUser->name }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('entity', 'Entity:') !!}
    <p>{{ $review->getProduct->name }}</p>
</div>

<!-- Slost Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $review->status }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $review->content }}</p>
</div>

<!-- Type Field -->
@isset($review->reviewImage)
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $review->reviewImage->file_name }}</p>
</div>
@endisset

