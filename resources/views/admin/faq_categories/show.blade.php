@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.faq-categories.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.faq_categories.index') }}">
                            @lang('global.faq-categories.title')</a>
                    </li> /
                    <li><span>{{ $faq_category->title }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.faq_categories.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
        <div class="content">
            
            <div class="active" id="faq_questions">
                <table class="striped responsive-table {{ count($faq_questions) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
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
                                    <td></td>
                                    <td></td>
                                    <td field-key='category'>{{ $faq_question->category->title or '' }}</td>
                                    <td field-key='question_text'>{!! $faq_question->question_text !!}</td>
                                    <td field-key='answer_text'>{!! $faq_question->answer_text !!}</td>
                                    <td>
                                        <div class="buttons">
                                            @can('faq_question_view')
                                            <a href="{{ route('admin.faq_questions.show',[$faq_question->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('faq_question_edit')
                                            <a href="{{ route('admin.faq_questions.edit',[$faq_question->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('faq_question_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.faq_questions.destroy', $faq_question->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
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


