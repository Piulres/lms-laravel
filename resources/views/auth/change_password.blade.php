@extends('layouts.app')

@section('content')
	<h3 class="page-title">@lang('global.app_change_password')</h3>

	@if(session('success'))
		<!-- If password successfully show message -->
		<div class="row">
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		</div>
	@else
		<!-- If no success message in flash session show change password form  -->
		<div class="card">
			{!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
			<div class="title">
				@lang('global.app_edit')
			</div>

			<div class="content">
				<div class="row">
					<div class="col m6 s12">
						{!! Form::label('current_password', trans('global.app_current_password'), ['class' => 'control-label']) !!}
						{!! Form::password('current_password', ['class' => 'validate']) !!}
						<span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
						@if($errors->has('current_password'))
							<p class="help-block">
								{{ $errors->first('current_password') }}
							</p>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col m6 s12">
						{!! Form::label('new_password', trans('global.app_new_password'), ['class' => 'control-label']) !!}
						{!! Form::password('new_password', ['class' => 'validate']) !!}
						<span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
						@if($errors->has('new_password'))
							<p class="help-block">
								{{ $errors->first('new_password') }}
							</p>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col m6 s12">
						{!! Form::label('new_password_confirmation', trans('global.app_password_confirm'), ['class' => 'control-label']) !!}
						{!! Form::password('new_password_confirmation', ['class' => 'validate']) !!}
						<span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
						@if($errors->has('new_password_confirmation'))
							<p class="help-block">
								{{ $errors->first('new_password_confirmation') }}
							</p>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						{!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light']) !!}
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>

	@endif
@stop

