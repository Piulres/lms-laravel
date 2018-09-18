@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.faq-categories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.faq-categories.fields.title')</th>
                            <td field-key='title'>{{ $faq_category->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#faq_questions" aria-controls="faq_questions" role="tab" data-toggle="tab">Questions</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="faq_questions">
<table class="table table-bordered table-striped {{ count($faq_questions) > 0 ? 'datatable' : '' }}">
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
                                    @can('faq_question_view')
                                    <a href="{{ route('admin.faq_questions.show',[$faq_question->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('faq_question_edit')
                                    <a href="{{ route('admin.faq_questions.edit',[$faq_question->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('faq_question_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.faq_questions.destroy', $faq_question->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.faq_categories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


