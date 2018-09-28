 @include('partials.front')

    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3 class="page-title">Course: {{ $course->title }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s7">
                <table class="table table-striped">
                    <tr>
                        <th>@lang('global.courses.fields.featured-image')</th>
                        <td field-key='featured_image'>
                            @if($course->featured_image)
                            <a href="{{ asset(env('UPLOAD_PATH').'/' . $course->featured_image) }}" target="_blank">
                                <!-- <img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->featured_image) }}"/> -->
                                <img style="max-width: 200px; height: auto;" src="{{ $course->featured_image }}"/>
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('global.courses.fields.duration')</th>
                        <td field-key='duration'>{{ $course->duration }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.courses.fields.instructor')</th>
                        <td field-key='instructor'>
                            @foreach ($course->instructor as $singleInstructor)
                                <span class="label label-info label-many">{{ $singleInstructor->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('global.courses.fields.lessons')</th>
                        <td field-key='lessons'>
                            @foreach ($course->lessons as $singleLessons)
                                <span class="label label-info label-many">{{ $singleLessons->title }}; </span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('global.courses.fields.categories')</th>
                        <td field-key='categories'>
                            @foreach ($course->categories as $singleCategories)
                                <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('global.courses.fields.description')</th>
                        <td field-key='description'>{!! $course->description !!}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.courses.fields.introduction')</th>
                        <td field-key='introduction'>{!! $course->introduction !!}</td>
                    </tr>
                </table>
            </div>
            <div class="col s3 offset-s2">
                @if (Auth::check())
                <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('start/'. $course->id) }}">
                    Start Course
                </a>
                <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('add/'. $course->id) }}">Add to my courses</a>
                @else
                <h4 class="center">Login to Start Course</h4>
                <a style="width: 100%; margin-bottom: 5px;" class="btn modal-trigger waves-effect waves-light black" data-target="modal1" href="#modal1">
                    Login
                </a>
                @endif
                <a style="width: 100%; margin-bottom: 5px;" class="btn waves-effect waves-light black" href="{{ url('library') }}" class="btn black">@lang('global.app_back_to_list')</a>
            </div>
        </div>

    </div>


 @include('partials.back')