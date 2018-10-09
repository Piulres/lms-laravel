@include('partials.front')

@foreach($lists as $list)
    @endforeach
<div class="title-panel" style="background-image: url('/images/background1.jpg');">

    <div class="container">
        
        <h2 class="page-title white-text">{{ $trail->title }}</h2>

        <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="Back to Course List"  href="{{ url('guide') }}"><i class="material-icons">keyboard_return</i></a>
            
    </div>
    
</div>

<div class="charles grey lighten-2">
    <div class="container">
        <div class="card-course hoverable">
            <div class="row">

                <div class="col s12">
                    <div class="ck">{!! $trail->introduction !!}</div>                                       
                </div>

            </div>
        </div>
        
        <div class="row kappa">     
                <div class="col m6 s12">
                    
                    <h4>Course</h4>
                    <p class="grey-text">What {{ $trail->title }} will teach you</p>

                    <ul class="collapsible popout">
                        @foreach ($trail->courses as $singleCourse)
                        <li>
                            <div class="collapsible-header white"><i class="material-icons">navigate_next</i>{{ $singleCourse->title }}<span class="new badge blue"></span></div>
                            <div class="collapsible-body white">
                                <span>{{ $singleCourse->introduction }}</span>
                                
                                    <a class="btn btn-floating waves-effect waves-light black tooltipped right" data-position="bottom" data-tooltip="Start Course" href="{{ url('courses/start/'. $singleCourse->id) }}"><i class="material-icons">play_arrow</i></a>
                                
                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>

            </div>
        </div>
    </div>
</div>
 @include('partials.back')