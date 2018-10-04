 @include('partials.front')

<div class="container">
    
    <div class="row">
        <!--
        <div class="col s1 black white-text">   
            @foreach($datacourses as $datacourse)
                <sup>{{ number_format($datacourse->progress, 9) }} %</sup>
                <p>Progress: </p><h5>{{ number_format($datacourse->progress, 0) }} %</h5>
            @endforeach
            <p style="color: red;">Lessons: {{ $total_lessons }}</p>
        </div>
        -->
        <div class="col s8">   
            <h2 class="page-title">Course - {{ $course->title }}</h2>
            <p>{{ $course->description }}</p>                
            <a href="{{ url('library') }}">Back to Course List ></a>
        </div>
       
    </div>

    <div class="row">
    </div>     

    <div class="row">
        @foreach($lessons as $lesson)
        <div class="col s12">         
            <div class="card hoverable">
                             
                <div class="content">
                    <h3>Lessons</h3>
                    {{ $lessons->links() }}

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
               
                <div class="card-action">
                    <a class="btn waves-effect waves-light black" href="{{ url('done/'. $lesson->id) }}">Submit Lesson</a>
                </div>
               
                
            </div>
        </div>
        @endforeach

       
    </div>

</div>
 @include('partials.back')