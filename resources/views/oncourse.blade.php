 @include('partials.front')

@foreach($lists as $list)
    @endforeach
<div class="title-panel" style="background-image: url('/images/background1.jpg');">

    <div class="container">
        
        <h2 class="page-title white-text">{{ $course->title }}</h2>

        <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="Back to Course List"  href="{{ url('library') }}"><i class="material-icons">keyboard_return</i></a>
            
      
    </div>
    
</div>

<div class="charles grey lighten-2">
    <div class="container"> 

        <div class="card-course hoverable">
            <!-- <div class="row">
                <div class="col s12">
                    <div class="ck">{!! $course->introduction !!}</div>                                       
                </div>  
            </div>     -->   
            <div class="row">         
                @foreach($lessons as $lesson)
                    <div class="col s12">


                        <div class="content">
                            <h3>Lessons</h3>
                            {{ $lessons->links() }}

                            <div class="card-action">
                                <a class="btn waves-effect waves-light black" href="{{ url('courses/done/'. $lesson->id) }}">Submit Lesson</a>
                            </div>
                            
                            <h5>title</h5>
                            <p>{{ $lesson->title }}</p>

                            <h5>slug</h5>
                            <p>{{ $lesson->slug }}</p>

                            <h5>introduction</h5>
                            <p>{{ $lesson->introduction }}</p>

                            <h5>content</h5>
                            <p>{{ $lesson->content }}</p>

                            <h5>study_material</h5>
                            <p>{{ $lesson->study_material }}</p>
                        </div>
                       
                        

                    </div>
                @endforeach
            </div>
           
        </div>

    </div>
</div>
 @include('partials.back')