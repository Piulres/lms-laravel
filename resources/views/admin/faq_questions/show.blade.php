@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.faq_questions.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.faq-questions.title')</h2>
    </div>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_view')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-md-6">
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


