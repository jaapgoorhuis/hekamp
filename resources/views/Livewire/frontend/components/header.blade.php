<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$page->title}}</title>
    <meta name="description" content="Crewa is gevestigd in Kootwijkerbroek in Nederland. Crewa is gespecialiseerd in het ontwikkelen van dashboards, web applicaties en websites.">
    <meta property="og:locale" content="nl_NL" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Crewa - Home" />
    <meta property="og:description" content="Crewa is gevestigd in Kootwijkerbroek in Nederland. Crewa is gespecialiseerd in het ontwikkelen van dashboards, web applicaties en websites." />
    <meta property="og:url" content="https://crewa.nl/" />
    <meta property="og:site_name" content="Crewa" />
    <meta property="article:modified_time" content="2024-03-18T09:42:28+00:00" />
    <meta property="og:image" content="https://crewa.nl/public/storage/images/frontend/logo-gold-white.png" />
    <meta name="twitter:card" content="summary_large_image" />


    @if($page->route == 'projecten')
        <link rel="stylesheet" href="{{asset('/css/projecten.css')}}"/>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/css/frontapp.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @livewireStyles
</head>
<body>
<div>
    @if($page->show_header)
        <div class="mobile-grid-menu d-xs-block d-sm-block-d-md-block d-lg-none d-xl-none d-xxl-none">
            <img src="{{asset('storage/images/frontend/logo-gold-white.png')}}" class="mobile-logo mobile-logo-default" alt="Crewa Logo"/>
            <button class="btn btn-primary menu-button" type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-controls="collapseWidthExample" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <div class="collapse collapse-horizontal" id="menuCollapse">
                    <div class="card card-body mobile-menu-card">
                        <img src="{{asset('storage/images/frontend/logo-gold-white.png')}}" class="mobile-logo" alt="Crewa Logo"/>

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 mobile-navbar">
                            @include('livewire.frontend.partials.menu')
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid menu d-none d-lg-block d-xl-block d-xxl-block">
            <nav class="navbar navbar-expand-lg menu">
                <div class="container">
                    <a class="logo-box" href="/"><img src="{{asset('storage/images/frontend/logo-gold-white.png')}}" class="logo" alt="Crewa Logo"/></a>
                    <div class="menu-items">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @include('livewire.frontend.partials.menu')
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="fixed-fill-block"></div>
        <div class="grid slider" @if($page->route == 'project-detail') style="background: url('/storage/images/frontend/projects/{{$project->friendly_route}}/{{$project->tumbnail}}')" @else style="background: url('storage/images/frontend/uploads/{{$page->header_image}}') @endif">
            <div class="grid-slider-shadow">
                <div class="container">
                    <div class="grid slider-box">
                        <div class="slider-box-text">
                            @if($page->route == 'project-detail')
                                <h1>
                                    <span class="color-white">{!! $project->title!!}</span>
                                </h1>
                            @else
                                <h1>
                                    <span class="color-white">  {!! $page->header_text!!}</span>
                                </h1>


                            @endif
                        </div>

                        <div class="button-group header-slider-box-button">
                            @if($page->route == 'project-detail')
                                <span class="next-button">Wat wij gedaan hebben</span>
                            @elseif($page->route == 'projecten')
                                <span class="next-button">Bekijk onze projecten</span>
                            @else
                                <span class="next-button">Lees meer</span>
                            @endif
                            <a class="white" href="#content-box-1"><span class="next-button-end"><i class="fa-solid fa-arrow-down"></i></span></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @yield('page')
    @else
        <div class="project-full-page-box" id="project-full-page-box" >
            <div class="slides" style="background:url('storage/images/frontend/uploads/{{$page->header_image}}')">
                <div class="project-blur-box">
                    @include('livewire.frontend.partials.projectMenu')
                    <div class="slide-text slide-text-header">
                        <h1 class="big-h1">Ons werk</h1>
                        <div class="clearfix"></div>
                        <a class="color-gold" href="#slide0"><i class="fa-solid fa-angles-down"></i></a>
                    </div>
                </div>
            </div>
            @yield('page')
        </div>
    @endif



    @if($page->show_footer)
        @include('livewire.frontend.components.footer')
    @endif
</div>
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

@if($page->route == 'projecten')
    <script src="{{asset('/js/projecten.js')}}"></script>
@endif

@if($page->route == 'index')
    <script src="{{asset('/js/home.js')}}"></script>
@endif

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
</body>

</html>
