@extends('admin.messenger.template')

@section('title', $title)

@section('messenger-content')
    <div class="card-panel">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($topics as $topic)
                <tr class="{{$topic->unread()?'unread': 'read'}}">
                    <td class="mail-contact"><a href="{{ route('admin.messenger.show', [$topic->id]) }}">{{ $topic->otherPerson()->email }}</a></td>
                    <td class="mail-subject"><a href="{{ route('admin.messenger.show', [$topic->id]) }}">{{ $topic->subject }}</a></td>
                    <td class="mail-date">{{ $topic->sent_at->diffForHumans() }}</td>
                    <td>
                    {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('Are you sure?');",
                            'route' => ['admin.messenger.destroy', $topic->id])) !!}
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                    </td>
                </tr>
                @empty
                <tr class="unread">
                    <td>You have no messages.</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection