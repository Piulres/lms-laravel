@extends('admin.messenger.template')

@section('title', 'New message')

@section('messenger-content')

    <div class="card">
    	<div class="card-title">
    		Reply
    	</div>
    	<div class="card-content">
	        <div class="col-md-12">
	            {{--{!! Form::open(['route' => ['admin.messenger.save'], 'method' => 'POST', 'novalidate', 'class' => 'stepperForm validate']) !!}--}}
	            {!! Form::model($topic, ['method' => 'PUT', 'route' => ['admin.messenger.update', $topic->id]]) !!}

	            @include('admin.messenger.form-partials.fields')
	            <div class="col-12">
	            	{!! Form::submit('Reply', ['class' => 'btn waves-effect waves-light grey']) !!}
	            </div>
	        </div>
	       </div>
    </div>

@stop
