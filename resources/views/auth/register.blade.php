@include('partials.front')


    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="jajaja white center">
                    <div class="row">                        
                      
                        <h4 class="black-text light">
                            Welcome to Learning Management System
                        </h4>
                        <h5 class="black-text light">
                            {{ ucfirst(config('app.name')) }} @lang('global.app_register')
                        </h5>

                    </div>                

                    @if (count($errors) > 0)
                        <div class="alert alert-danger red-text">
                            <strong>Whoops!</strong> There were problems with input:
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="input-field{{ $errors->has('name') ? ' has-error' : '' }}">
                               
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                    <label for="name">@lang('global.app_name')</label>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </input>

                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    <label for="email">@lang('global.app_email')</label>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </input>

                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                                
                                <input id="password" type="password" class="form-control" name="password" required>
                                    <label for="password">@lang('global.app_password')</label>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </input>

                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <label for="password-confirm">@lang('global.app_confirm_password')</label>
                                </input>
                             </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                
                                <button type="submit" class="btn waves-effect waves-light black">
                                    @lang('global.app_register')
                                </button>
                                
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="parallax grey">
           
        </div>
    </div>

 @include('partials.back')

