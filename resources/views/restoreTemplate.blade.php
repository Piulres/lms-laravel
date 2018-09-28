<div class="buttons">
    @can($gateKey.'delete')
        {!! Form::open(array(
            'style' => 'display: inline-block;',
            'method' => 'POST',
            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
        'route' => [$routeKey.'.restore', $row->id])) !!}
        {!! Form::button('<i class="far fa-window-restore"></i>', ['class'=>'btn-square blue-text', 'type'=>'submit']) !!}
        {!! Form::close() !!}
    @endcan
    @can($gateKey.'delete')
        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
        'route' => [$routeKey.'.perma_del', $row->id])) !!}
        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['class'=>'btn-square red-text', 'type'=>'submit']) !!}
        {!! Form::close() !!}
    @endcan
</div>