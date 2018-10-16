@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m8"><h1>@lang('global.faq-questions.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.faq-questions.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m4 right-align">

                @can('faq_question_create')
                    <a href="{{ route('admin.faq_questions.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add question
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="content">
            <table class="no-order table table-striped ajaxTable @can('faq_question_delete') dt-select @else dt-show @endcan">
                <thead>
                    <tr>
                        <th></th>
                        @can('faq_question_delete')
                            <th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>
                        @endcan

                        <th>@lang('global.faq-questions.fields.category')</th>
                        <th>@lang('global.faq-questions.fields.question-text')</th>
                        <th>@lang('global.faq-questions.fields.answer-text')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('faq_question_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.faq_questions.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.faq_questions.index') !!}';
            window.dtDefaultOptions.columns = [
                {data: 'category.title', name: 'category.title'},
                @can('faq_question_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan
                {data: 'category.title', name: 'category.title'},
                {data: 'question_text', name: 'question_text'},
                {data: 'answer_text', name: 'answer_text'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection