<div class=input-field">
    {!! Form::label('receiver', 'Recipient', ['class' => 'control-label']) !!}

    @if(isset($users))
        {!! Form::select('receiver', $users, old('receiver'), ['class' => 'form-control']) !!}
    @elseif(isset($user))
        {!! Form::text('receiver', old('receiver', $user ? $user : ''), ['class' => 'form-control', 'disabled']) !!}
    @endif
</div>
<div class="input-field">
    {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}

    @if(!isset($user))
        {!! Form::text('subject', old('subject', isset($topic) ? $topic->subject : ''), ['class' => 'form-control']) !!}
    @else
        {!! Form::text('subject', old('subject', isset($topic) ? $topic->subject : ''), ['class' => 'form-control', 'disabled']) !!}
    @endif

    @if ($errors->has('subject'))
        <span class="helper-text" data-error="wrong" data-success="right">
            <strong>{{ $errors->first('subject') }}</strong>
        </span>
    @endif
</div>
<div class="input-field">
    {!! Form::label('content', 'Message', ['class' => 'control-label']) !!}
    {!! Form::textarea('content', old('content'), ['class' => 'materialize-textarea']) !!}
    <span class="helper-text" data-error="wrong" data-success="right"></span>
    @if($errors->has('content'))
        <span class="helper-text" data-error="wrong" data-success="right">
            {{ $errors->first('content') }}
        </span>
    @endif
</div>
@section('javascript')
    @parent

@stop