<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if($page)
            {{$page->title}}
       @endif
    </title>
    <meta name="description" content="Crewa is gevestigd in Kootwijkerbroek in Nederland. Crewa is gespecialiseerd in het ontwikkelen van dashboards, web applicaties en websites.">
    <meta property="og:locale" content="{{$locale}}_{{$locale}}" />
    <meta property="og:type" content="website" />
    @if($page)
        <meta property="og:title" content="{{$page->title}} -> Home" />
    @endif
    @if($page)
        <meta property="og:description" content="{{$page['meta_description_'.$locale]}}" />
    @endif
    <meta property="og:url" content="{{env('APP_URL')}}" />
    <meta property="og:site_name" content="{{env('APP_NAME')}}" />
    <meta property="og:image" content="{{env('APP_URL')}}/storage/images/frontend/hekamp_logo.png" />
    <meta name="twitter:card" content="summary_large_image" />



    @if($page)
        @if($page->route == 'projecten')
            <link rel="stylesheet" href="{{asset('/css/projecten.css')}}"/>
        @endif
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,700,800">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" >

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/css/frontapp.css')}}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script defer src="https://cdn.jsdelivr.net/gh/hunghg255/quill-resize-module/dist/quill-resize-image.min.js"></script>
    <script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script>
    @filepondScripts
    @livewireStyles
</head>
<body>
<div>

@if($authUser)
    <div class="logged_in_header">
     <a class="btn btn-outline-secondary" href="/login">Ga naar backend</a>
    </div>
@endif


        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">

                <a class="navbar-brand" href="/{{$locale}}/index"><img src="/storage/images/frontend/hekamp_logo.png"/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        @foreach($menu_items as $item)
                            @if($item->page)
                        <li class="nav-item">
                            <a class="nav-link @if($slug == $item->page->route)active @endif" aria-current="page" href="/{{$item->page->route}}">

                                @if( $item['title_'.\Illuminate\Support\Facades\App::currentLocale()] == '')
                                    {{$item['title_nl']}}
                                @else
                                    {!! $item['title_'.\Illuminate\Support\Facades\App::currentLocale()]!!}
                                @endif

                            </a>
                        </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
        <ul class="locale-menu">
            <li><a @if($locale == 'nl' ) class="active" @endif href="/nl/{{$slug}}/{{$route}}">NL</a></li>
            <li class="spacer">/ </li>
            <li><a  @if($locale == 'de' ) class="active" @endif href="/de/{{$slug}}/{{$route}}"> DE</a> </li>
            <li class="spacer">/ </li>
            <li><a  @if($locale == 'en' ) class="active" @endif href="/en/{{$slug}}/{{$route}}"> EN</a></li>
        </ul>
        <div class="header-image" style="background-image:url('/storage/images/frontend/uploads/hekamp_header.jpg');">
            <div class="header-filter">

            </div>
            <div class="header-content">
                <h1 class="title">HEKAMP</h1>
                <small class="subtitle">{{__('pages.small_header_title')}}</small>
                <br/>
                <br/>
                <div class="input-group mb-3">
                    <form class="search-form" action="/{{\Illuminate\Support\Facades\App::getLocale()}}/search" method="GET">
                    <input type="text" name="search" class="form-control search-field" placeholder="{{__('pages.search_placeholder')}}" aria-label="Kuilbakken" aria-describedby="button-addon2">
                    <button type="submit" wire:model="searchQuery" href="/{{\Illuminate\Support\Facades\App::getLocale().'/search'}}" class="btn btn-outline-secondary search-button" type="button">{{__('pages.search')}}</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @yield('page')
        @include('livewire.frontend.components.footer')

</div>
@livewireScripts
<script src="{{asset('/js/core.js')}}"></script>
<script src="{{asset('/js/script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>


</body>

</html>
