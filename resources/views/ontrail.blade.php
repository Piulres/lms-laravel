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
            <!-- <div class="row">
                <div class="col s12">
                    <div class="ck">{!! $trail->introduction !!}</div>                                       
                </div>  
            </div>     -->   
            <div class="row">         
                @foreach($courses as $course)
                    <div class="col s12">


                        <div class="content">
                            <h3>courses</h3>
                            {{ $courses->links() }}

                            <div class="card-action">
                                <a class="btn waves-effect waves-light black" href="{{ url('trail/done/'. $course->id) }}">Submit course</a>
                            </div>
                            
                            <h5>title</h5>
                            <p>{{ $course->title }}</p>

                            <h5>slug</h5>
                            <p>{{ $course->slug }}</p>

                            <h5>introduction</h5>
                            <p>{{ $course->introduction }}</p>
                        </div>

                    </div>
                @endforeach
            </div>
           
        </div>

    </div>
</div>
 @include('partials.back')