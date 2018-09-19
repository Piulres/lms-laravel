 @include('partials.front')

    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3 class="page-title">On Course: {{ $course->title }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                {{ $course->title }}
                {{ $course->description }}
            </div>
        </div>
        <div class="row"> 
            <div class="col s12">  
                <a href="{{ url('library') }}" class="btn black">@lang('global.app_back_to_list')</a>
            </div>
        </div>
            
       

    </div>


 @include('partials.back')