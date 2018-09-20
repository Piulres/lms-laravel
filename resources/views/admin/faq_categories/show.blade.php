@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.faq_categories.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.faq-categories.title')</h2>
    </div>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_view')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-md-6">
                    <table class="table bordered striped">
                        <tr>
                            <th>@lang('global.faq-categories.fields.title')</th>
                            <td field-key='title'>{{ $faq_category->title }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#faq_questions" aria-controls="faq_questions">Questions</a></li>
            </ul>
        </div>
        <div class="card-content">
            
            <div class="active" id="faq_questions">
                <table class="striped responsive-table {{ count($faq_questions) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>@lang('global.faq-questions.fields.category')</th>
                            <th>@lang('global.faq-questions.fields.question-text')</th>
                            <th>@lang('global.faq-questions.fields.answer-text')</th>
                            <th>&nbsp;</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if (count($faq_questions) > 0)
                            @foreach ($faq_questions as $faq_question)
                                <tr data-entry-id="{{ $faq_question->id }}">
                                    <td field-key='category'>{{ $faq_question->category->title or '' }}</td>
                                    <td field-key='question_text'>{!! $faq_question->question_text !!}</td>
                                    <td field-key='answer_text'>{!! $faq_question->answer_text !!}</td>
                                    <td>
                                        <div class="buttons">
                                            @can('faq_question_view')
                                            <a href="{{ route('admin.faq_questions.show',[$faq_question->id]) }}" class="waves-effect waves-light btn-small btn-square grey"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('faq_question_edit')
                                            <a href="{{ route('admin.faq_questions.edit',[$faq_question->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('faq_question_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.faq_questions.destroy', $faq_question->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


