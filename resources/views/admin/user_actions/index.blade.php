@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.user-actions.title')</h4>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="card-title">
                <h5>@lang('global.app_list')</h5>
            </div>

            <table class="striped responsive-table {{ count($user_actions) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>
                        
                        <th>@lang('global.user-actions.created_at')</th>
                        <th>@lang('global.user-actions.fields.user')</th>
                        <th>@lang('global.user-actions.fields.action')</th>
                        <th>@lang('global.user-actions.fields.action-model')</th>
                        <th>@lang('global.user-actions.fields.action-id')</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($user_actions) > 0)
                        @foreach ($user_actions as $user_action)
                            <tr data-entry-id="{{ $user_action->id }}">
                                
                                <td>{{ $user_action->created_at or '' }}</td>
                                <td field-key='user'>{{ $user_action->user->name or '' }}</td>
                                <td field-key='action'>{{ $user_action->action }}</td>
                                <td field-key='action_model'>{{ $user_action->action_model }}</td>
                                <td field-key='action_id'>{{ $user_action->action_id }}</td>
                                
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        
    </script>
@endsection