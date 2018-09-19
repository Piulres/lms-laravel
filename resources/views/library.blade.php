 @include('partials.front')

    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 center">
                    <h3>
                        <i class="mdi-content-send brown-text">
                        </i>
                    </h3>
                    <h4>
                        Library
                    </h4>
                    <p class="left-align light">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Maecenas eros justo, ullamcorper a sapien id, viverra ultrices eros. Morbi sem neque, posuere et pretium eget, bibendum sollicitudin lacus. Aliquam eleifend sollicitudin diam, eu mattis nisl maximus sed. Nulla imperdiet semper molestie. Morbi massa odio, condimentum sed ipsum ac, gravida ultrices erat. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                    </p>
                </div>
                <div class="col s12 center">                
                @if (Auth::check())

                @else
                    <a href="{{ url('/login') }}" class="btn black">Login</a>
                    <a href="{{ url('/register') }}" class="btn black">Register</a>

                @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section">

            <div class="row">

                <div class="col s12 center">
                
                    <h4>Courses</h4>

                </div>                
                
            </div>

            <div class="row">

                @foreach($courses as $course)
                   
                        <div class="col s12 m6 l4 xl4">
                            <div class="card">
                                <div class="card-image">
                                    <img src="{{ asset(env('UPLOAD_PATH') . $course->featured_image) }}"/>
                                    <!-- <img class="responsive-img" src="images/background1.jpg"> -->
                                    <span class="card-title">{{ $course->title }}</span>
                                </div>
                                <div class="card-content">
                                    <p>{{ $course->description }}</p>
                                    <div class="ratings">
                                        
                                    </div>
                                </div>
                                <div class="card-action">
                                    <a href="{{ url('courses/'. $course->id) }}">Link</a>
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
                    <h5 class="header col s12 light">
                        The LMS plataform right for you
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax">
            <img alt="Unsplashed background img 2" src="images/background3.jpg"/>
        </div>
    </div>


 @include('partials.back')