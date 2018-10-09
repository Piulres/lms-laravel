 @include('partials.front')

    @foreach($lists as $list)
    @endforeach
    @foreach($datacourses as $datacourse)
    @endforeach

    <div class="title-panel" style="background-image: url('../images/background1.jpg');">

        <div class="container">
            
            <!-- <img class="responsive-img" src="../images/background1.jpg"> -->
            <h2 class="page-title white-text">{{ $course->title }}</h2>
            @if (Auth::check())
                @if ($list->view === null)
            <a class="btn btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-tooltip="Add to Courses" href="{{ url('courses/add/'. $course->id) }}"><i class="material-icons">add</i></a>
                @else
            <a class="btn btn-floating waves-effect waves-light black tooltipped" data-position="bottom" data-tooltip="Start Course"  href="{{ url('courses/start/'. $course->id) }}"><i class="material-icons">play_arrow</i></a>
                @endif
            @else
            <a class="btn btn-floating waves-effect waves-light black modal-trigger tooltipped" data-position="bottom" data-tooltip="Login to Start" data-target="modal1" href="#modal1"><i class="material-icons">person</i></a>
            @endif
            <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="Back to Course List"  href="{{ url('library') }}"><i class="material-icons">keyboard_return</i></a>
         
         </div>
        
    </div>

    <div class="charles grey lighten-2">
        <div class="container">
            <div class="card-course hoverable">
                <div class="row">

                    <div class="col s12">
                        <div class="ck">{!! $course->introduction !!}</div>                                       
                    </div>

                </div>
            </div>
            
            <div class="row kappa">     
                    <div class="col m6 s12">
                        
                        <h4>Lessons</h4>
                        <p class="grey-text">What {{ $course->title }} will teach you</p>

                        <ul class="collapsible popout">
                            @foreach ($course->lessons as $singleLessons)
                            <li>
                                <div class="collapsible-header white"><i class="material-icons">navigate_next</i>{{ $singleLessons->title }}<span class="new badge blue"></span></div>
                                <div class="collapsible-body white"><span>{{ $singleLessons->introduction }}</span></div>
                            </li>
                            @endforeach
                        </ul>

                    </div>                    

                    <div class="col m5 s12 offset-m1">

                        <h4>Testimonal</h4>
                        <p class="grey-text">What people talk about {{ $course->title }}.</p>

                        <ul class="collection shadow">

                            @foreach($datas as $data)
                            
                            @if ($data->testimonal === null)
                            @else
                            <li class="collection-item avatar ">
                                <img src="../images/background1.jpg" alt="" class="circle">
                                <span class="title blue-text">{{ $data->name }} {{ $data->lastname }}</span>
                                <p>{{ $data->testimonal }}</p> 

                                <a href="#!" class="pupa amber-text">
                                    {{ $data->rating }}
                                </a>
                                <a href="#!" class="pepe">
                                    <i class="material-icons amber-text">grade</i>
                                </a>

                            </li>
                            @endif

                            @endforeach                         

                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
    

 @include('partials.back')