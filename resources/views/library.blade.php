 @include('partials.front')

    <div class="container">
        <div class="section">
            
            @if (Auth::check())
            <div class="row">
            <div class="col s12 center">                    
                <h2>                   
                    My Courses
                    
                </h2>                    
            </div>
            </div>
            @else
            @endif

           
            @if (Auth::check())
            <div class="row">
                @foreach($mycourses as $mycourse)

                    <div class="col s12 m6 l4 xl4">
                        <div class="card">
                            <div class="card-image">
                                <!-- <img src="{{ asset(env('UPLOAD_PATH') . $mycourse->featured_image) }}"/> -->
                                <img class="responsive-img" src="images/background1.jpg">
                                <span class="card-title">{{ $mycourse->title }}</span>
                            </div>
                            <div class="card-content">
                                <p>{{ $mycourse->description }}</p>
                                <div class="ratings">
                                    
                                </div>
                            </div>
                            <div class="card-action">
                                <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('courses/'. $mycourse->course_id) }}">View course</a>
                                <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('start/'. $mycourse->course_id) }}">Start course</a>
                                <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('remove/'. $mycourse->course_id) }}">Remove from my courses</a>
                            </div>
                        </div>
                    </div>

                @endforeach
                
            </div>
            @else
            @endif


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
            
            <div class="row">

                @foreach($courses as $course)
                   
                    <div class="col s12 m6 l4 xl4">
                        <div class="card">
                            <div class="card-image">
                                <!-- <img src="{{ asset(env('UPLOAD_PATH') . $course->featured_image) }}"/> -->
                                <img class="responsive-img" src="images/background1.jpg">
                                <span class="card-title">{{ $course->title }}</span>
                            </div>
                            <div class="card-content">
                                <p>{{ $course->description }}</p>
                                <div class="ratings">
                                    
                                </div>
                            </div>
                            <div class="card-action">
                                <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('courses/'. $course->id) }}">View course</a>
                                @if (Auth::check())                                
                                <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('add/'. $course->id) }}">Add to my courses</a>
                                @else
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach
            
            </div>            

        </div>
    </div>

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