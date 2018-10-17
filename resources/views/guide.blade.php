@include('partials.front')

    

@if (Auth::check())

<div class="charles grey lighten-3">
    <div class="container">

        <div class="row">
            <div class="col s12 center">
                <h2>
                    My Trails
                </h2>
            </div>
        </div>
     
    
        <div class="grid">

            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>

            @foreach($mytrails as $mytrail)

                <div class="grid-item card hoverable sticky-action">
                    <div class="card-image waves-effect waves-block waves-light">                                
                        <img class="responsive-img" src="images/background1.jpg">
                   </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><p class="c-title">{{ $mytrail->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Read More">more_vert</i></span>
                        @if ($mytrail->progress === null)
                        <sup class="blue-text">Progress: 0 %</sup></br>
                        @else
                        <sup class="blue-text">Progress: {{ $mytrail->progress }} %</sup></br>
                        @endif
                        <sup class="c-sup">{{ $mytrail->description }}</sup>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{{ $mytrail->title }}<i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Close">close</i></span>
                        <p class="c-desc">{{ $mytrail->description }}</p>
                    </div>
                    <div class="card-action">
                        <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Trail" href="{{ url('trails/'. $mytrail->trail_id) }}"><i class="material-icons">remove_red_eye</i></a>
                        <a class="btn btn-floating waves-effect waves-light red tooltipped modal-trigger" data-target="#remove{{$mytrail->trail_id}}" href="#modal2" data-position="bottom" data-tooltip="Remove from trails"><i class="material-icons">remove</i></a>
                        <a class="btn btn-floating waves-effect waves-light black tooltipped" data-position="bottom" data-tooltip="Start Trail" href="{{ url('trails/start/'. $mytrail->trail_id) }}"><i class="material-icons">play_arrow</i></a>
                    </div>
                </div>

                <div class="modal" id="#remove{{$mytrail->trail_id}}">
                    <div class="modal-content">
                        <h4>
                            Remover
                        </h4>
                        <p>
                            Você deseja remover o <span class="red-text">{{ $mytrail->title }}</span> de sua lista?
                        </p>
                        <small class="grey-text">Seus dados de progresso estarão sempre salvos :)</small>
                    </div>
                    <div class="modal-footer">
                        <a class="left modal-close btn waves-effect waves-red darken-4 red white-text btn-flat" href="{{ url('trails/remove/'. $mytrail->trail_id) }}">
                            Yes
                        </a>
                        <a class="left modal-close btn waves-effect waves-green black white-text btn-flat" href="#!">
                            No
                        </a>
                    </div>
                </div>

            @endforeach

        </div>            

    </div>
</div>

@else
@endif

<div class="charles grey lighten-2">
    <div class="container">

        <div class="row">
            <div class="col s12 center">
                <h2>
                    @if (Auth::check())
                    Trails
                    @else
                    Guide
                    @endif
                </h2>
            </div>
        </div>
        
        <div class="grid">

            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>
            
            @if($mytrails->count() != 0)

                @foreach($diff as $trail) 

                    <div class="grid-item card hoverable sticky-action">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="responsive-img" src="images/background1.jpg">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4"><p class="c-title">{{ $trail->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Read More">more_vert</i></span>
                                <sup class="c-sup">{{ $trail->description }}</sup>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">{{ $trail->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Close">close</i></span>
                                <p class="c-desc">{{ $trail->description }}</p>
                            </div>
                            <div class="card-action">
                            @if (Auth::check())
                                <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Trail" href="{{ url('trails/'. $trail->id) }}"><i class="material-icons">remove_red_eye</i></a>
                                <a class="btn btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-tooltip="Add to Trails" href="{{ url('trails/add/'. $trail->id) }}"><i class="material-icons">add</i></a>
                            @else
                                <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Trail" href="{{ url('trails/'. $trail->id) }}"><i class="material-icons">remove_red_eye</i></a>
                            @endif
                            </div>
                        </div>

                @endforeach

            @else

                @foreach($trails as $trail)

                <div class="grid-item card hoverable sticky-action">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="responsive-img" src="images/background1.jpg">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><p class="c-title">{{ $trail->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Read More">more_vert</i></span>
                        <sup class="c-sup">{{ $trail->description }}</sup>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{{ $trail->title }}</p><i class="material-icons right tooltipped" data-position="bottom" data-tooltip="Close">close</i></span>
                        <p class="c-desc">{{ $trail->description }}</p>
                    </div>
                    <div class="card-action">
                    @if (Auth::check())
                        <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Trail" href="{{ url('trails/'. $trail->id) }}"><i class="material-icons">remove_red_eye</i></a>
                        <a class="btn btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-tooltip="Add to Trails" href="{{ url('trails/add/'. $trail->id) }}"><i class="material-icons">add</i></a>
                    @else
                        <a class="btn btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-tooltip="View Trail" href="{{ url('trails/'. $trail->id) }}"><i class="material-icons">remove_red_eye</i></a>
                    @endif
                    </div>
                </div>

                @endforeach

            @endif
            
        </div>
    </div> 
</div>   

 <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    
                </div>
                <div class="row">
                    <div class="col s12 center">
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="parallax">
            <img alt="Unsplashed background img 2" src="../assets/img/image-banner.png"/>
        </div>
    </div>

@include('partials.back')