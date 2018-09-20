@extends('admin.messenger.template')

@section('title', $title)

@section('messenger-content')
    <div class="collection">
        <div class="collection-item row align-items-center">
            <div class="col-4 col-md-4">Email</div>
            <div class="col-5 col-md-5">Subject</div>
            <div class="col-2 text-right">Time</div>
            <div class="col-1 text-center">Action</div>
        </div>
        @forelse($topics as $topic)
            <div class="collection-item row align-items-center">
                <div class="col-4 col-md-4">
                    <a href="{{ route('admin.messenger.show', [$topic->id]) }}" class="{{$topic->unread()?'unread':false}}">
                        {{ $topic->otherPerson()->email }}
                    </a>
                </div>
                <div class="col-5 col-md-5">
                    <a href="{{ route('admin.messenger.show', [$topic->id]) }}" class="{{$topic->unread()?'unread':false}}">
                        {{ $topic->subject }}
                    </a>
                </div>
                <div class="col-2 text-right">{{ $topic->sent_at->diffForHumans() }}</div>
                <div class="col-1 text-center">
                    {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('Are you sure?');",
                            'route' => ['admin.messenger.destroy', $topic->id])) !!}
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        @empty
            <div class="collection-item">
                You have no messages.
            </div>
        @endforelse
    </div>

    <style>
        .messenger-table tr:first-child td {
            border-top: 0 !important;
        }
        .unread {
            font-weight: bold;
            color:black;
        }
    </style>

@endsection