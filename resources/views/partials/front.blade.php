<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <title>
            Site Comunicação
        </title>
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="{{ url('/') }}/css/materialize.css" media="screen,projection" rel="stylesheet" type="text/css"/>
            <link href="{{ url('/') }}/css/style.css" media="screen,projection" rel="stylesheet" type="text/css"/>
        </link>
    </head>
    <body>
        <nav class="white" role="navigation">
            <div class="nav-wrapper container">
                <a class="brand-logo" href="/">
                    <!-- <img src="http://static.campanhaporto.com.br/guide/logo/porto-seguro/institucional/marca/inst-bgd-sm.svg"/> -->
                    <img src="{{ url('/') }}/images/Logo_RPX.png"/>
                    <!-- <p class="mamama">INSERT LOGO HERE</p> -->
                </a>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a class="black-text" href="{{ url('/library') }}">
                            Get Started
                        </a>
                    </li>
                    <li>
                        <a class="black-text" href="{{ url('/library') }}">
                            Library
                        </a>
                    </li>
                    @if (Auth::check())
                    <li>                        
                        <a class="btn waves-effect waves-light black" href="{{ url('/admin/home') }}">
                            <i class="material-icons left">dashboard</i>dashboard
                        </a>

                    </li>
                    <li>
                        <a class="btn modal-trigger waves-effect waves-light black" href="{{ url('/logout') }}">
                            Logout
                        </a>
                    </li>
                        
                    @else

                    <li>
                        <a class="btn modal-trigger waves-effect waves-light black" data-target="modal1" href="#modal1">
                            Login
                        </a>
                    </li>
                        
                    @endif

                </ul>
                <ul class="sidenav" id="slide-out">
                    <!-- <li>
                        <div class="user-view">
                            <div class="background">
                                <img src="{{ url('/') }}/images/01.abb.jpg">
                                </img>
                            </div>
                            <a href="#user">
                                <img class="circle" src="{{ url('/') }}/images/01.cabu.jpg"/>
                            </a>
                            <a href="#name">
                                <span class="white-text name">
                                    E.John
                                </span>
                            </a>
                            <a href="#email">
                                <span class="white-text email">
                                    kkkk@gmail.com
                                </span>
                            </a>
                        </div>
                    </li> -->
                    <li>
                        <a class="black-text" href="{{ url('/library') }}">
                            Get Started
                        </a>
                    </li>
                    <li>
                        <div class="divider">
                        </div>
                    </li>
                    <li>
                        <a class="black-text" href="{{ url('/library') }}">
                            Library
                        </a>
                    </li>
                    <li>
                        <div class="divider">
                        </div>
                    </li>
                    <li>
                        <a class="btn modal-trigger waves-effect waves-light black" data-target="modal1" href="#modal1">
                            Login
                        </a>
                    </li>
                </ul>
                <a class="sidenav-trigger" data-target="slide-out" href="#">
                    <i class="material-icons black-text">
                        menu
                    </i>
                </a>
                <!-- Modal Login -->
                <div class="modal" id="modal1">
                    <div class="modal-content">
                        <div class="row center">
                            <h5 class="black-text light">
                                Welcome to Learning Management System
                            </h5>
                        </div>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were problems with input:
                                <br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="input-field">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        <label for="email">
                                            Email
                                        </label>
                                    </input>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field">
                                    <input id="password" type="password" class="form-control" name="password">
                                        <label for="password">
                                            Password
                                        </label>
                                    </input>
                                </div>
                            </div>

                            <div class="row center">
                                <button type="submit" class="modal-close btn waves-effect waves-light black">
                                    Login
                                </button>
                            </div>

                            <div class="itens row center">
                                <a class="black-text" href="{{ route('auth.password.reset') }}">
                                    Forgot Password?
                                </a>
                            </div>

                            <div class="itens row center">
                                <a class="black-text" href="{{ route('auth.register') }}">
                                    Register
                                </a>
                            </div>

                            <div class="itens row center">
                                <a class="black-text" target="_blank" href="https://www.google.com">
                                    Problems? Click Here
                                </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </nav>