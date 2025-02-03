<div class="col-12 col-md-12 col-lg-4 col-xl-3 col-xxl-2">
<nav class="navbar navbar-expand-lg bg-light category-navbar">
    <div class="container-fluid category-navbar-container">
        <button class="navbar-toggler category-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon category-navbar-toggler-icon"></span> Categorieën
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

                <div class="col-12 col-sm-6 col-md-6 col-lg-12 col-xl-12 side-menu">
                    <div class="menu-header">
                        <a type="button" class="btn-close-yellow" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-label="Close"><i class='bx bx-x'></i></a>

                    </div>
                    @foreach($categories as $category)

                        <table class="table table-striped side-menu-table">
                            <thead>
                            <tr>
                                <th class="side-menu-title" scope="col">
                                    <div class="menu-icon">
                                        <?php $mediaItems = $category->getMedia('icon');?>

                                        @if(count($mediaItems))
                                            <img src="{{$mediaItems[0]->getFullUrl()}}" class="menu-icon-image"/>
                                        @else
                                            <img src="/storage/images/frontend/verreiker_icon.png" class="menu-icon-image"/>
                                        @endif
                                    </div>
                                    <span class="side-menu-head-title">
                        @if( $category['title_'.\Illuminate\Support\Facades\App::currentLocale()] == '')
                                            {{$category['title_nl']}}
                                        @else
                                            {!! $category['title_'.\Illuminate\Support\Facades\App::currentLocale()]!!}
                                        @endif
                    </span>
                                </th>
                            </tr>
                            </thead>
                            @foreach($category->subCategories()->orderBy('order_id', 'asc')->get() as $subcategory)
                                <tbody>
                                <tr>
                                    <th @if($route == $subcategory->route) class="active" @endif onclick="window.location='/{{$locale}}/{{$category->route}}/{{$subcategory->route}}';" scope="row"><a href="/{{$locale}}/{{$category->route}}/{{$subcategory->route}}">{{$subcategory->title_nl}}</a></th>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
</nav>
</div>
