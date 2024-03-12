<div>
    <div class="home-content-box-1" id="content-box-1">

            <div class="content-box-1-title">
                <div class="content-box-1-text">
                    <h2>
                        <span class="color-white">Projecten</span>
                    </h2>
                </div>
                <div class="content-box-1-buttons">
                    <button class="carousel-control-prev" type="button" data-bs-target="#projecten" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Vorige</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#projecten" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Volgende</span>
                    </button>
                </div>
            </div>



            <div id="projecten" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner w-100">
                    @foreach($projects as $key => $project)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <div class="col-md-4 home-slider-image">
                            <div class="card card-body card-body-slider-image">
                                <div class="home-slider-image-image" style="background: url('storage/images/frontend/projects/{{$project->friendly_route}}/{{$project->tumbnail}}');">
                                    <div class="slider-shadow-home">
                                        <img alt="Crewa projecten" class="home-slider-cover-image" src="{{asset('storage/images/frontend/slider-image.jpg')}}" style="visibility: hidden">
                                        <div class="slider-box-button">
                                            <a class="slider-button-round" href="/project-detail/{{$project->friendly_route}}"><i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-item-text-box">
                                    <span class="slider-item-text">{!! $project->title !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </div>

    <div class="home-content-box-2" style="background-image:url('/storage/images/frontend/home-what-we-do.jpg')">
       <div class="container container-content-box-2">
       <div class="what-we-do col-md-12 col-lg-7 col-xl-6">
           @foreach($this->pageBlocks as $key => $blocks)
                   <?php $blockNames = \App\Models\Block::where('id', $blocks->block_id)->get();?>
               @include('Livewire.Blocks.'.$blockNames[0]['block_name'].'.frontend.index', ['blocks' => $blocks])
           @endforeach
       </div>
    </div>
</div>
   <script>
       $('.carousel .carousel-item').each(function(){
           let minPerSlide = 3;
           let next = $(this).next();
           if (!next.length) {
               next = $(this).siblings(':first');
           }
           next.children(':first-child').clone().appendTo($(this));

           for (let i=0;i<minPerSlide;i++) {
               next=next.next();
               if (!next.length) {
                   next = $(this).siblings(':first');
               }

               next.children(':first-child').clone().appendTo($(this));
           }
       });
   </script>
</div>
