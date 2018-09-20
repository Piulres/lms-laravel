@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.faq_questions.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.faq-questions.title')</h2>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.faq_questions.store']]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_create')</h3>
        </div>
        
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('category_id', trans('global.faq-questions.fields.category').'*') !!}
                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control', 'required' => '']) !!}
                    <span class="helper-text" data-error="@if($errors->has('category_id')){{ $errors->first('category_id') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('question_text', trans('global.faq-questions.fields.question-text').'*') !!}
                        {!! Form::textarea('question_text', old('question_text'), ['class' => 'materialize-textarea ', 'placeholder' => '', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('question_text')){{ $errors->first('question_text') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('answer_text', trans('global.faq-questions.fields.answer-text').'*') !!}
                        {!! Form::textarea('answer_text', old('answer_text'), ['class' => 'materialize-textarea ', 'placeholder' => '', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('answer_text')){{ $errors->first('answer_text') }}@endif" data-success="right"></span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light grey']) !!}
    {!! Form::close() !!}
@stop

