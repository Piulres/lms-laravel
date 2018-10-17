<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>


<body class="hold-transition skin-blue sidebar-mini yay-hide">
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
            <div class="alert alert-danger red-text">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
   
    </div>
    
    <div class="search-bar">
        <form action="#!">
            <!-- Header -->
            <a class="search-bar-toggle grey-text text-darken-2" href="#!"><i class="mdi-navigation-close"></i></a>

            <!-- Search Input -->
            <div class="input-field">
                <i class="mdi-action-search prefix"></i>
                <input type="text" name="con-search" placeholder="Type to search...">
            </div>

            <h4>Serach results for 'Con'</h4>

            <hr>
            <!-- Search Results -->
            <div class="search-results">

                <div class="row">
                    <div class="col s12 l4">
                        <h4>Users</h4>

                        <div class="each-result">
                            <img src="assets/_con/images/user2.jpg" alt="Felecia Castro" class="circle photo">
                            <div class="title">Felecia Castro</div>
                            <div class="label">Content Manager</div>
                        </div>

                        ...
                    </div>
                    ...
                </div>

            </div>
        </form>
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