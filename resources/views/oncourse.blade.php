 @include('partials.front')

    <div class="container">
        <div class="row">
            <div class="col s12">
                @foreach($datacourses as $datacourse)

                    <p>Nº total de aulas: {{ $total_lessons }}</p>
                    <p>Porcentagem: {{ $percentage }}</p>
                    <p>Next: {{ $next }}</p>

                    <p>Progress: {{ number_format($datacourse->progress, 9) }}</p>
                 
                    
                @endforeach
            </div>
            <div class="col s12">   
                <h2 class="page-title">On Course: {{ $course->title }}</h2>
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
                    <div>{{ $lesson->slug }}</div>
                    <div>{{ $lesson->introduction }}</div>
                    <div>{{ $lesson->content }}</div>
                    <div>{{ $lesson->study_material }}</div>
                    <hr>

                </div>
            @endforeach
        </div>  

        <div class="row"> 
            <div class="col s12">  
                <a href="{{ url('library') }}" class="btn black">@lang('global.app_back_to_list')</a>
            </div>
        </div>            
       

    </div>


 @include('partials.back')