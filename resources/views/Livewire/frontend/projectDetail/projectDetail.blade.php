<div>
    <div  class="project-detail-content-box">
        <div class="container">
            <div id="content-box-1" class="project-detail-content-box-1-title">
                <div class="button-group header-slider-box-button" >
                    <span class="next-button">Terug naar onze cases</span>
                    <a class="white" href="/projecten"><span class="next-button-end"><i class="fa-solid fa-arrow-left"></i></span></a>
                </div>
                <div class="project-detail-content-box-1-text" >
                    <h2><span class="color-gold">Ons werk</span></h2>
                    <div class="project-detail-description">
                        {!! $this->project->description !!}
                    </div>
                </div>

                <div class="project-detail-image-wrapper">
                    <h1 class="color-white project-detail-image-title">Het resultaat</h1>
                    @foreach($this->project->projectImages as $project_images)
                        <img alt="{{$this->project->title}}" src="{{asset('/storage/images/frontend/projects/'.$project->friendly_route.'/'.$project_images->image)}}"/>
                    @endforeach
                </div>

                <div class="project-details">
                    <div class="row">
                        @if($this->project->url)
                        <div class="col-md-4 col-6">
                            <h3><span class="color-gold">Website</span></h3>
                            <a target="_blank" href="{{$this->project->url}}">{{$this->project->url}}</a>
                        </div>
                        @endif
                        <div class="col-md-4 col-6">
                            <h3><span class="color-gold">Categorie</span></h3>

                            <a target="_blank" href="/{{$this->project->projectCategorie->title}}">{{$this->project->projectCategorie->title}}</a>
                        </div>
                    </div>
                </div>

                <div class="project-detail-more-info">

                </div>
            </div>
        </div>
    </div>
</div>
