@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.faq-questions.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.faq_questions.index') }}">
                            @lang('global.faq-questions.title')</a>
                    </li> /
                    <li><span>@lang('global.app_create')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.faq_questions.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>


    {!! Form::open(['method' => 'POST', 'route' => ['admin.faq_questions.store']]) !!}
    <div class="card">
        <div class="title">
            <h5>@lang('global.app_create')</h5>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col m6 s12">
                    {!! Form::label('category_id', trans('global.faq-questions.fields.category').'*') !!}
                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control', 'required' => '']) !!}
                    <span class="helper-text" data-error="@if($errors->has('category_id')){{ $errors->first('category_id') }}@endif" data-success="right"></span>
                </div>

            </div>
            <div class="row">
                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('answer_text', trans('global.faq-questions.fields.answer-text').'*') !!}
                        {!! Form::textarea('answer_text', old('answer_text'), ['class' => 'materialize-textarea ', 'placeholder' => '', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('answer_text')){{ $errors->first('answer_text') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('question_text', trans('global.faq-questions.fields.question-text').'*') !!}
                        {!! Form::textarea('question_text', old('question_text'), ['class' => 'materialize-textarea ', 'placeholder' => '', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('question_text')){{ $errors->first('question_text') }}@endif" data-success="right"></span>
                    </div>
                </div>
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

