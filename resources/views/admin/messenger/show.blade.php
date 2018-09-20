@extends('admin.messenger.template')

@section('title', $topic->subject)

@section('messenger-content')

    <div class="row justify-content-end col-12">
        <a href="{{ route('admin.messenger.edit', [$topic->id]) }}" class="btn waves-effect waves-light grey">Reply</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="margin-top:8px;">
                @foreach($topic->messages as $message)
                <div class="card-content" style="padding-left:15px;">
                    <div class="card-title padding-5">
                        <h6><strong>Sender:</strong> {{ $message->sender->email }}</h6>
                        <h6><strong>At: </strong>{{  $message->sent_at->diffForHumans()/*format('d F Y h:i')*/ }}</h6>
                    </div>
                    <div class="divider"></div>
                    <h5><strong>Message:</strong></h5>
                    <p>{{ $message->content }}</p>
                </div>

                @endforeach
            </div>

        </div>
    </div>

    <style>
        .messenger-table tr:first-child td {
            border-top: 0 !important;
        }

        .unread {
            font-weight: bold;
        }

        .list-group-item {
            border-top: 0;
            border-bottom: 0;
        }

        .list-group-item:first-child {
            border-top: 1px solid #ddd;
        }

        .list-group-item:last-child {
            border-bottom: 1px solid #ddd;
        }

        .list-group-item:hover {
            background-color: #eee;
        }
    </style>

@endsection