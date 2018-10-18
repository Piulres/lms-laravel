 @include('partials.front')

    

    @if (Auth::check())
    
    <div class="charles grey lighten-3">
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
                            <span class="card-title activator grey-text text-darken-4"><p class="c-title">{{ $mycourse->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Read More">more_vert</i></span>
                            @if ($mycourse->progress === null)
                            <sup class="blue-text">Progress: 0 %</sup></br>
                            @else
                            <sup class="blue-text">Progress: {{ number_format($mycourse->progress, 0, '.', '') }} %</sup></br>
                            @endif
                            <sup class="c-sup">{{ $mycourse->description }}</sup>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">{{ $mycourse->title }}<i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Close">close</i></span>
                            <p class="c-desc">{{ $mycourse->description }}</p>
                        </div>
                        <div class="card-action">
                            <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Course" href="{{ url('courses/'. $mycourse->course_id) }}"><i class="material-icons">remove_red_eye</i></a>
                            <a class="btn btn-floating waves-effect waves-light red tooltipped modal-trigger" data-target="#remove{{$mycourse->course_id}}" href="#modal2" data-position="bottom" data-tooltip="Remove from Courses"><i class="material-icons">remove</i></a>
                            <a class="btn btn-floating waves-effect waves-light black tooltipped" data-position="bottom" data-tooltip="Start Course" href="{{ url('courses/start/'. $mycourse->course_id) }}"><i class="material-icons">play_arrow</i></a>
                        </div>
                    </div>

                    <div class="modal" id="#remove{{$mycourse->course_id}}">
                        <div class="modal-content">
                            <h4>
                                Remover
                            </h4>
                            <p>
                                Você deseja remover o <span class="red-text">{{ $mycourse->title }}</span> de sua lista?
                            </p>
                            <small class="grey-text">Seus dados de progresso estarão sempre salvos :)</small>
                        </div>
                        <div class="modal-footer">
                            <a class="left modal-close btn waves-effect waves-red darken-4 red white-text btn-flat" href="{{ url('courses/remove/'. $mycourse->course_id) }}">
                                Yes
                            </a>
                            <a class="left modal-close btn waves-effect waves-green black white-text btn-flat" href="#!">
                                No
                            </a>        
                        </div>
                    </div>

                @endforeach

            </div>            

        </div>
    </div>
    
    @else
    @endif
    
    <div class="charles grey lighten-2">
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
                
                @if($mycourses->count() != 0)

                    @foreach($diff as $course) 

                        <div class="grid-item card hoverable sticky-action">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img class="responsive-img" src="images/background1.jpg">
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4"><p class="c-title">{{ $course->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Read More">more_vert</i></span>
                                    <sup class="c-sup">{{ $course->description }}</sup>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4">{{ $course->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Close">close</i></span>
                                    <p class="c-desc">{{ $course->description }}</p>
                                </div>
                                <div class="card-action">
                                @if (Auth::check())
                                    <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Course" href="{{ url('courses/'. $course->id) }}"><i class="material-icons">remove_red_eye</i></a>
                                    <a class="btn btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-tooltip="Add to Courses" href="{{ url('courses/add/'. $course->id) }}"><i class="material-icons">add</i></a>
                                @else
                                    <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Course" href="{{ url('courses/'. $course->id) }}"><i class="material-icons">remove_red_eye</i></a>
                                @endif
                                </div>
                            </div>

                    @endforeach

                @else

                    @foreach($courses as $course)

                        <div class="grid-item card hoverable sticky-action">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="responsive-img" src="images/background1.jpg">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4"><p class="c-title">{{ $course->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Read More">more_vert</i></span>
                                <sup class="c-sup">{{ $course->description }}</sup>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">{{ $course->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Close">close</i></span>
                                <p class="c-desc">{{ $course->description }}</p>
                            </div>
                            <div class="card-action">
                            @if (Auth::check())
                                <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Course" href="{{ url('courses/'. $course->id) }}"><i class="material-icons">remove_red_eye</i></a>
                                <a class="btn btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-tooltip="Add to Courses" href="{{ url('courses/add/'. $course->id) }}"><i class="material-icons">add</i></a>
                            @else
                                <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Course" href="{{ url('courses/'. $course->id) }}"><i class="material-icons">remove_red_eye</i></a>
                            @endif
                            </div>
                        </div>

                    @endforeach

                @endif
                
            </div>
        </div> 
    </div>   

    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    
                </div>
                <div class="row">
                    <div class="col s12 center">
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="parallax">
            <img alt="Unsplashed background img 2" src="../assets/img/image-banner.png"/>
        </div>
    </div>

 @include('partials.back')