<!DOCTYPE html>
<html lang="en">
<head>
    @livewireStyles

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crewa - Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/css/app.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script defer src="https://cdn.jsdelivr.net/gh/hunghg255/quill-resize-module/dist/quill-resize-image.min.js"></script>





</head>
<body id="body-pd">
<header class="header" id="header">
    <div onclick="toggle_nav()" class="header_toggle" id="navbar-button"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <a href="/auth/account">
        <i class='bx bxs-user-detail'></i>
    </a>
</header>
<div class="l-navbar" id="backend-nav">
    <nav class="nav">
        <div>
            <a href="/" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">{{env('APP_NAME')}}</span> </a>
            <div class="nav_list">
                <a href="/auth/dashboard" class="nav_link"> <span class="nav_name">Dashboard</span> </a>
                <a href="/auth/pages" class="nav_link"> <span class="nav_name">Pagina's</span> </a>
                <a href="/auth/categories" class="nav_link"> <span class="nav_name">Categorieën</span> </a>
                <a href="/auth/downloads" class="nav_link"> <span class="nav_name">Downloads</span> </a>
                <a href="/auth/site" class="nav_link"> <span class="nav_name">Website instellingen</span> </a>
                <a href="/auth/menu" class="nav_link"> <span class="nav_name">Menu</span> </a>
                <a href="/auth/search" class="nav_link"> <span class="nav_name">Zoekregister</span> </a>
            </div>
        </div>
        <li>
            <a class="nav_link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">Uitloggen</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>
    </nav>
</div>

<div wire:key="test" class="height-100 bg-light">
    {{$slot}}
</div>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

@filepondScripts
@livewireScripts

<script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.4.0/dist/livewire-sortable.js"></script>
<script>
    function toggle_nav() {
        const element = document.getElementById("backend-nav");

        if (element.classList.contains('show')) {
            document.getElementById("navbar-button").style.marginLeft = "0";
            element.classList.remove('show')
        } else {
            element.classList.add('show');
            document.getElementById("navbar-button").style.marginLeft = "280px";
        }
    }
</script>

</body>
</html>
