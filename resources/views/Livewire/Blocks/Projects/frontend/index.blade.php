
@foreach($projects as $key => $project)
    <div id="slide{{$key}}" class="slides">
        <div class="slide-image"  style="background:url('storage/images/frontend/projects/{{$project->friendly_route}}/{{$project->tumbnail}}')">
            <div class="project-blur-box">
                <div class="slide-text">
                    <h1 class="big-h1">{!! $project->title !!}</h1>
                    <a class="color-gold" href="#slide{{$key+1}}"><i class="fa-solid fa-angles-down"></i></a>
                </div>
            </div>
        </div>
        <div class="project-slide-text">
            <div class="container">
                <div class="list-items-home">
                    <div class="item">
                        <div class="list-item-home-icon"><i class="fa-solid fa-laptop-code"></i></div>
                        <div class="list-item-home-text">

                            <div class="project-small-text">
                                {!!$project->small_description!!}
                            </div>
                            <br/>
                            <a class="read-more" href="/project-detail/{{$project->friendly_route}}"><span class="color-gold">Lees meer <i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

