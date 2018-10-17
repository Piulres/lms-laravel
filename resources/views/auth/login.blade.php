 @include('partials.front')


    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="jajaja white center">
                    <div class="row">
                        
                        <h4 class="black-text light">
                            Welcome to Learning Management System
                        </h4>                 
                        <h5 class="black-text light">{{ ucfirst(config('app.name')) }} @lang('global.app_login')
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

                        <div class="row center">
                            <a class="black-text" href="{{ route('auth.password.reset') }}">
                                Forgot Password?
                            </a>
                        </div>

                        <div class="row center">
                            <a class="black-text" href="{{ url('login/facebook') }}">
                                Register with facebook
                            </a>
                        </div>

                        <div class="row center">
                            <a class="black-text" href="{{ url('login/google') }}">
                                Register with Google
                            </a>
                        </div>

                        <div class="row center">
                            <a class="black-text" href="{{ route('auth.register') }}">
                                Register
                            </a>
                        </div>

                        <div class="row center">
                            <a class="black-text" target="_blank" href="https://www.google.com">
                                Problems? Click Here
                             </a>
                        </div>
                        

                    </form>

                </div>
            </div>
        </div>
        <div class="parallax grey">
           
        </div>
    </div>

 @include('partials.back')
