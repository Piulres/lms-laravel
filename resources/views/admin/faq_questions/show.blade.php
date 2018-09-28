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
                    <li><span>{!! $faq_question->question_text !!}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.faq_questions.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h5>@lang('global.app_view')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col s6">
                    <table class="bordered striped">
                        <tr>
                            <th>@lang('global.faq-questions.fields.category')</th>
                            <td field-key='category'>{{ $faq_question->category->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.faq-questions.fields.question-text')</th>
                            <td field-key='question_text'>{!! $faq_question->question_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.faq-questions.fields.answer-text')</th>
                            <td field-key='answer_text'>{!! $faq_question->answer_text !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


