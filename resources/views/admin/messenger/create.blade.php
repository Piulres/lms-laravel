@extends('admin.messenger.template')

@section('title', 'New message')

@section('messenger-content')
<div class="card">
	<div class="content">
        <div class="col-md-12">
            {!! Form::open(['route' => ['admin.messenger.store'], 'method' => 'POST', 'novalidate', 'class' => 'stepperForm validate']) !!}

            @include('admin.messenger.form-partials.fields')

            {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light white-color']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop
