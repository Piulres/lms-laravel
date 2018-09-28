 @include('partials.front')

    <div class="container">
        <div class="row">
            <div class="col s1 black white-text">   
                @foreach($datacourses as $datacourse)
                    <!-- <sup>{{ number_format($datacourse->progress, 9) }} %</sup> -->
                    <p>Progress: </p><h5>{{ number_format($datacourse->progress, 0) }} %</h5>
                @endforeach
                <p style="color: red;">Lessons: {{ $total_lessons }}</p>
            </div>
            <div class="col s11">   
                <h2 class="page-title">Course: {{ $course->title }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                {{ $course->title }}
                {{ $course->description }}                
            </div>            

            <div class="col s6">
                
                <ul>
                    <!-- <li><a href="{{ url('remove/'. $course->id) }}">Remover Curso</a></li> -->
                    <!-- <li><a href="{{ url('end/'. $course->id) }}">Finalizar Curso</a></li> -->
                </ul> 

            </div>
        </div>        

        <div class="row"> 
            @foreach($lessons as $lesson)
                <div class="col s12">
                   
                    <h4>{{ $lesson->title }}</h4>
                    <div>{{ $lesson->status }}</div>
                    <div>{{ $lesson->slug }}</div>
                    <div>{{ $lesson->introduction }}</div>
                    <div>{{ $lesson->content }}</div>
                    <div>{{ $lesson->study_material }}</div>
                    
                    <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('done/'. $lesson->id) }}">></a>
                    <hr>

                </div>
            @endforeach
            {{ $lessons->links() }}
        </div>  

        <div class="row"> 
            <div class="col s12">  
                <a href="{{ url('library') }}" class="btn black">@lang('global.app_back_to_list')</a>
            </div>
        </div>            
       

    </div>


 @include('partials.back')