@extends('admin.messenger.template')

@section('title', 'New message')

@section('messenger-content')
{!! Form::open(['route' => ['admin.messenger.store'], 'method' => 'POST', 'novalidate', 'class' => 'stepperForm validate']) !!}
<div class="card">
    <div class="content">
        <div class="col-md-12">

            @include('admin.messenger.form-partials.fields')

        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        {!! Form::button(trans('global.app_create') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
    </div>
</div>
{!! Form::close() !!}

@stop
