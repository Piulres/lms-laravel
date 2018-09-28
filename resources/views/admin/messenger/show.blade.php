@extends('admin.messenger.template')

@section('title', $topic->subject)

@section('messenger-content')
    @foreach($topic->messages as $message)
    <div class="card-panel">
        <!-- Subject -->
        <h3 class="mail-subject">Message</h3>
        <!-- /Subject -->
        <div class="row">
            <!-- From -->
            <div class="col s6">Email: <strong>{{ $message->sender->email }}</strong></div>
            <!-- /From -->
            <!-- Date -->
            <div class="col s6 right-align">
                <span>{{  $message->sent_at->diffForHumans()/*format('d F Y h:i')*/ }}</span>
            </div>
            <!-- /Date -->
        </div>
        <hr>
        <!-- Message -->
        <div class="mail-text">
            {{ $message->content }}
        </div>
        <!-- /Message -->
        <hr>
        <a href="{{ route('admin.messenger.edit', [$topic->id]) }}" class="btn white grey-text text-darken-2">
            <i class="mdi-content-send left"></i>
            Reply
        </a>
        <a href="mail-compose.html" class="btn white grey-text text-darken-2">
            <i class="mdi-action-delete left"></i>
            Remove</a>
    </div>

    @endforeach

@endsection