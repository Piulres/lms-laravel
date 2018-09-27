<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>


<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper">

@include('partials.topbar')
@include('partials.sidebar')

    <div class="content-wrap">
        <!-- Main content -->
        @if(isset($siteTitle))
            <h3 class="page-title">
                {{ $siteTitle }}
            </h3>
        @endif

        @if (Session::has('message'))
            <div class="alert alert-info">
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif
        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
    <footer>
        © <?php echo date('Y'); ?> <strong>RPerformance Group</strong>. All rights reserved.
    </footer>
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}


@include('partials.javascripts')
</body>
</html>