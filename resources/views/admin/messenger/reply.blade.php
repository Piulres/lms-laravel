@extends('admin.messenger.template')

@section('title', 'New message')

@section('messenger-content')

	<div class="card-panel">
		{!! Form::model($topic, ['method' => 'PUT', 'route' => ['admin.messenger.update', $topic->id]]) !!}
		<!-- To -->
		@include('admin.messenger.form-partials.fields')

		{!! Form::submit('Reply', ['class' => 'btn white grey-text text-darken-2']) !!}
	</div>

@stop
