@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>Dashboard</h1>
                <ul>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col l4 s12">
            <a href="{{ route('admin.users.index') }}"
               class="card-panel stats-card indigo lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-users"></i>
                <span class="count">{{ $users->count() }}</span>
                <div class="name">Users</div>
            </a>
        </div>

        <div class="col l4 s12">
            <a href="{{ route('admin.courses.index') }}"
               class="card-panel stats-card blue lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-book-reader"></i>
                <span class="count">{{ $courses->count() }}</span>
                <div class="name">Courses</div>
            </a>
        </div>

        <div class="col l4 s12">
            <a href="{{ route('admin.trails.index') }}"
               class="card-panel stats-card teal lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-train"></i>
                <span class="count">{{ $trails->count() }}</span>
                <div class="name">Trails</div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col l4 s12">
            <div class="card" draggable="false">
                <div class="title">
                    <h5>Recently added users</h5>
                    {{--<a class="close" href="#" draggable="false">--}}
                    {{--<i class="mdi-content-clear"></i>--}}
                    {{--</a>--}}
                    <a class="minimize" href="#" draggable="false">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content orders-card">
                    @foreach($users as $user)
                        <h4>{{ $user->name }}</h4>
                        <div class="row">
                            <div class="col s6">
                                <small>Total Progress</small>
                            </div>
                            <div class="col s6 right-align">77%
                            </div>
                        </div>
                        <div class="progress small">
                            <div class="determinate" style="width: 77%"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col l4 s12">
            <div class="card">
                <div class="title">
                    <h5>Recently added courses</h5>
                    {{--<a class="close" href="#"><i class="mdi-content-clear"></i></a>--}}
                    <a class="minimize" href="#"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content todo-card">
                    <ul class="collection">
                        @foreach($courses as $course)
                        <li class="collection-item"><div>{{ $course->title }}<a href="#!" class="secondary-content"><i class="todo-remove mdi-action-delete"></i></a></div></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col l4 s12">
            <div class="card">
                <div class="title">
                    <h5>Recently added trails</h5>
                    {{--<a class="close" href="#"><i class="mdi-content-clear"></i></a>--}}
                    <a class="minimize" href="#"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content todo-card">
                    <ul class="collection">
                        @foreach($trails as $trail)
                        <li class="collection-item"><div>{{ $trail->title }}<a href="#!" class="secondary-content"><i class="todo-remove mdi-action-delete"></i></a></div></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
