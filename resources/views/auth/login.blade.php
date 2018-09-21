 @include('partials.front')


    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="jajaja white center">
                    <div class="row">       
                    
                    <!-- 
                        <h3>
                            <i class="mdi-content-send brown-text">
                            </i>
                        </h3>
                        <h4>
                            Login
                        </h4>
                        
                        <div class="card">
                            <div class="card-title">{{ ucfirst(config('app.name')) }} @lang('global.app_login')</div>
                            <div class="card-content">
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> @lang('global.app_there_were_problems_with_input'):
                                    <br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form class="form-horizontal"
                                      role="form"
                                      method="POST"
                                      action="{{ url('login') }}">
                                    <input type="hidden"
                                           name="_token"
                                           value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@lang('global.app_email')</label>

                                        <div class="col-md-6">
                                            <input type="email"
                                                   class="form-control"
                                                   name="email"
                                                   value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@lang('global.app_password')</label>

                                        <div class="col-md-6">
                                            <input type="password"
                                                   class="form-control"
                                                   name="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <a href="{{ route('auth.password.reset') }}">@lang('global.app_forgot_password')</a>
                                            <br>
                                            <a href="{{ route('auth.register') }}">@lang('global.app_registration')</a>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <label>
                                                <input type="checkbox"
                                                       name="remember"> @lang('global.app_remember_me')
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit"
                                                    class="btn btn-primary"
                                                    style="margin-right: 15px;">
                                                @lang('global.app_login')
                                            </button>
                                        </div>
                                    </div>

                                    

                                </form>
                            </div>
                        </div>
                    -->
                        
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
        <div class="parallax">
            <img alt="Unsplashed background img 2" src="images/background3.jpg"/>
        </div>
    </div>

 @include('partials.back')
