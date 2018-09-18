@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.faq-questions.title')</h3>
    @can('faq_question_create')
    <p>
        <a href="{{ route('admin.faq_questions.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('faq_question_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('faq_question_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
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
            window.dtDefaultOptions.columns = [@can('faq_question_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'category.title', name: 'category.title'},
                {data: 'question_text', name: 'question_text'},
                {data: 'answer_text', name: 'answer_text'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection