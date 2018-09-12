<div class="buttons d-flex align-items-center justify-content-end justify-content-md-center">
	@can($gateKey.'view')
	    <a href="{{ route($routeKey.'.show', $row->id) }}" class="waves-effect waves-light btn-small btn-square"><i class="material-icons">remove_red_eye</i></a>
	@endcan
	@can($gateKey.'edit')
	    <a href="{{ route($routeKey.'.edit', $row->id) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
	@endcan
	@can($gateKey.'delete')
	    {!! Form::open(array(
	        'style' => 'display: inline-block;',
	        'method' => 'DELETE',
	        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
	        'route' => [$routeKey.'.destroy', $row->id])) !!}
	    {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
	    {!! Form::close() !!}
	@endcan
</div>