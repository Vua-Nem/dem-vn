<!-- Full Name Field -->
<div class="form-group">
    {!! Form::label('full_name', 'Full Name:') !!}
    <p>{{ $landingContactForm->full_name }}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{{ $landingContactForm->phone }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $landingContactForm->email }}</p>
</div>

<!-- Source Field -->
<div class="form-group">
    {!! Form::label('source', 'Source:') !!}
    <p>{{ $landingContactForm->source }}</p>
</div>

<!-- Note Field -->
<div class="form-group">
    {!! Form::label('note', 'Note:') !!}
    <p>{{ $landingContactForm->note }}</p>
</div>

