<div>
    <div class="container">
        <div class="row">
            @include('livewire.frontend.components.sideMenu')
            <div class="col-12 col-md-8 col-xl-10 site-content">
                <div class="row">
                        @if(count($this->currentCategory->products))
                            @foreach($this->currentCategory->products as $product)
                            <div class="row product-content-row ">
                                <div id="{{$product->id}}" class="col-12 col-md-12 col-lg-12 col-xl-12 product-content">
                                    <div class="product-content-header">
                                        @if($product['title_'.\Illuminate\Support\Facades\App::getLocale()])
                                            {{$product['title_'.\Illuminate\Support\Facades\App::getLocale()]}}
                                        @else
                                            {{$product['title_nl']}}
                                        @endif
                                    </div>
                                        <div class="product-content-body col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-12 col-lg-4 col-xl-6 product-images">
                                                    <div id="carouselExampleControls{{$product->id}}" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                                <?php $count = 0;?>
                                                            @foreach($product->getMedia('files') as $files)
                                                                <div class="carousel-item @if($count == 0) active @endif">
                                                                    <img src="{{$files->getFullUrl()}}" class="d-block w-100" alt="...">
                                                                </div>
                                                                    <?php $count ++?>
                                                            @endforeach
                                                        </div>
                                                        @if($count > 1)
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{$product->id}}" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{$product->id}}" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12 col-lg-8 col-xl-6">

                                                    @if($product['product_text_'.\Illuminate\Support\Facades\App::getLocale()])
                                                        <h1 class="yellow">{{$product['title_'.\Illuminate\Support\Facades\App::getLocale()]}}</h1>
                                                        {!!$product['product_text_'.\Illuminate\Support\Facades\App::getLocale()]!!}
                                                    @else
                                                        <h1 class="grey">{!!$product['title_nl']!!}</h1>
                                                        <br/>
                                                        {!!$product['product_text_nl']!!}
                                                    @endif
                                                </div>
                                                <div class="col-12">
                                                   <h3 class="grey">Downloads</h3>

                                                </div>

                                            </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <div class="row product-content-row ">
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 product-content">
                                        <div class="product-content-header">
                                            {{__('pages.no-products-title')}}
                                        </div>
                                        <div class="product-content-body col-12">
                                            {{__('pages.no-products-content')}}
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
