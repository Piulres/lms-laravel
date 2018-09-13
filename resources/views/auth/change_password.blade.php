@extends('layouts.app')

@section('content')
	<div class="header-title">
		<h4>@lang('global.app_change_password')</h4>
	</div>

	@if(session('success'))
		<!-- If password successfully show message -->
		<div class="row">
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		</div>
	@else
		{!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
		<!-- If no success message in flash session show change password form  -->
		<div class="card">

			<div class="card-content">
				<div class="title col-12">
					<h5>@lang('global.app_edit')</h5>
				</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="input-field">
							{!! Form::label('current_password', trans('global.app_current_password'), ['class' => 'control-label']) !!}
							{!! Form::password('current_password', ['class' => 'form-control']) !!}
							<span class="helper-text" data-error="wrong" data-success="right"></span>
							@if($errors->has('current_password'))
								<p class="help-block">
									{{ $errors->first('current_password') }}
								</p>
							@endif
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-4">
						<div class="input-field">
							{!! Form::label('new_password', trans('global.app_new_password'), ['class' => 'control-label']) !!}
							{!! Form::password('new_password', ['class' => 'form-control']) !!}
							<span class="helper-text" data-error="wrong" data-success="right"></span>
							@if($errors->has('new_password'))
								<p class="help-block">
									{{ $errors->first('new_password') }}
								</p>
							@endif
						</div>
					</div>

					<div class="col-12 col-md-4">
						<div class="input-field">
							{!! Form::label('new_password_confirmation', trans('global.app_password_confirm'), ['class' => 'control-label']) !!}
							{!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
							<span class="helper-text" data-error="wrong" data-success="right"></span>
							@if($errors->has('new_password_confirmation'))
								<p class="help-block">
									{{ $errors->first('new_password_confirmation') }}
								</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		{!! Form::button('<i class="material-icons right">send</i>Save', ['class'=>'btn waves-effect waves-light', 'type'=>'submit']) !!}
		{!! Form::close() !!}
	@endif
@stop

