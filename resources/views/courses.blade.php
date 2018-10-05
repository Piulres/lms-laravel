 @include('partials.front')

    @foreach($lists as $list)
    @endforeach
    <div class="charles grey lighten-3">
        <div class="container">
            <div class="row">
                <div class="col s12 itans-title">

                    <h2 class="page-title left">{{ $course->title }}</h2>                                  
                   
                    @if (Auth::check())
                    @if ($list->view === null)
                    <a class="btn left btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-tooltip="Add to Courses" href="{{ url('add/'. $course->id) }}"><i class="material-icons">add</i></a>
                    @else
                    <a class="btn left btn-floating waves-effect waves-light black tooltipped" data-position="bottom" data-tooltip="Start Course"  href="{{ url('start/'. $course->id) }}"><i class="material-icons">play_arrow</i></a>
                    @endif
                    @else
                    <a class="btn left btn-floating waves-effect waves-light black modal-trigger tooltipped" data-position="bottom" data-tooltip="Login to Start" data-target="modal1" href="#modal1"><i class="material-icons">person</i></a>
                    @endif
                    <a class="btn left btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="Back to Course List"  href="{{ url('library') }}"><i class="material-icons">keyboard_return</i></a>
        
                </div>                 
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="ck">{!! $course->introduction !!}</div>                                       
                </div>                 
            </div>
            <div class="row">
                <div class="col s12">
                    @if (Auth::check())
                    @if ($list->view === null)
                    <a class="btn btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-tooltip="Add to Courses" href="{{ url('add/'. $course->id) }}"><i class="material-icons">add</i></a>
                    @else
                    <a class="btn btn-floating waves-effect waves-light black tooltipped" data-position="bottom" data-tooltip="Start Course"  href="{{ url('start/'. $course->id) }}"><i class="material-icons">play_arrow</i></a>
                    @endif
                    @else
                    <a class="btn btn-floating waves-effect waves-light black modal-trigger tooltipped" data-position="bottom" data-tooltip="Login to Start" data-target="modal1" href="#modal1"><i class="material-icons">person</i></a>
                    @endif
                    <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="Back to Course List"  href="{{ url('library') }}"><i class="material-icons">keyboard_return</i></a>
                </div>
            </div>

            <div class="row">
                <div class="col m6 s12">
                    <div class="nomg">
                        <h4>Lessons</h4>
                        <p class="grey-text">What {{ $course->title }} will teach you</p>
                    </div>
                    <div class="collection">
                    @foreach ($course->lessons as $singleLessons)
                        <a href="#!" class="collection-item black-text"><span class="new badge blue"></span>{{ $singleLessons->title }}</a>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    

 @include('partials.back')