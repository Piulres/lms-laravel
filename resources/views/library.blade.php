 @include('partials.front')

    @if (Auth::check())
    <section class="home grey lighten-3">
        <div class="container">            
            
            <div class="row">
                <div class="col s12 center">
                    <h2>
                        My Courses
                    </h2>                    
                </div>
            </div>
         
        
            <div class="grid">

                <div class="grid-sizer"></div>
                <div class="gutter-sizer"></div>

                @foreach($mycourses as $mycourse)                    
                    
                    <div class="grid-item card hoverable sticky-action">
                        <div class="card-image waves-effect waves-block waves-light">                                
                            <img class="responsive-img" src="images/background1.jpg">
                       </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4"><p class="c-title">{{ $mycourse->title }}</p><i class="material-icons right">more_vert</i></span>
                            @if ($mycourse->progress === null)
                            <sup class="blue-text">Progress: 0 %</sup></br>
                            @else
                            <sup class="blue-text">Progress: {{ $mycourse->progress }} %</sup></br>
                            @endif
                            <sup class="c-sup">{{ $mycourse->description }}</sup>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">{{ $mycourse->title }}<i class="material-icons right">close</i></span>
                            <p class="c-desc">{{ $mycourse->description }}</p>
                        </div>
                        <div class="card-action">
                            <a class="btn btn-floating waves-effect waves-light blue" href="{{ url('courses/'. $mycourse->course_id) }}"><i class="material-icons">remove_red_eye</i></a>
                            <a class="btn btn-floating waves-effect waves-light red" href="{{ url('remove/'. $mycourse->id) }}"><i class="material-icons">remove</i></a>
                            <a class="btn btn-floating waves-effect waves-light black" href="{{ url('start/'. $mycourse->course_id) }}"><i class="material-icons">play_arrow</i></a>
                        </div>
                    </div>

                @endforeach

            </div>            

        </div>
    </section>
    @else
    @endif

    <section class="home grey lighten-5">
        <div class="container">

            <div class="row">
                <div class="col s12 center">
                    <h2>
                        @if (Auth::check())
                        Courses
                        @else
                        Library
                        @endif
                    </h2>                    
                </div>
            </div>
            
            <div class="grid">

                <div class="grid-sizer"></div>
                <div class="gutter-sizer"></div>
                
                @foreach($courses as $course)
                
                    <div class="grid-item card hoverable sticky-action">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="responsive-img" src="images/background1.jpg">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4"><p class="c-title">{{ $course->title }}</p><i class="material-icons right">more_vert</i></span>
                            <sup class="c-sup">{{ $course->description }}</sup>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">{{ $course->title }}</p><i class="material-icons right">close</i></span>
                            <p class="c-desc">{{ $course->description }}</p>
                        </div>
                        <div class="card-action">
                        @if (Auth::check())
                            <a class="btn btn-floating waves-effect waves-light blue" href="{{ url('courses/'. $course->id) }}"><i class="material-icons">remove_red_eye</i></a>
                            <a class="btn btn-floating waves-effect waves-light green" href="{{ url('add/'. $course->id) }}"><i class="material-icons">add</i></a>
                        @else
                            <a class="btn btn-floating waves-effect waves-light blue" href="{{ url('courses/'. $course->id) }}"><i class="material-icons">remove_red_eye</i></a>
                        @endif
                        </div>
                    </div>

                @endforeach

            </div>            

        </div>
    </section>

    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h4 class="header col s12 light">
                        The LMS plataform right for you
                    </h4>
                </div>
                <div class="row">                
                    <div class="col s12 center">
                        @if (Auth::check())
                        @else
                            <a style="min-width: 200px;" href="{{ url('/login') }}" class="btn black">Login</a>
                            <a style="min-width: 200px;" href="{{ url('/register') }}" class="btn black">Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="parallax">
            <img alt="Unsplashed background img 2" src="images/background3.jpg"/>
        </div>
    </div>

 @include('partials.back')