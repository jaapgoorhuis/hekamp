<div>
    <div class="container">
        <div class="row">
            @include('livewire.frontend.components.sideMenu')
            <div class="col-12 col-md-12 col-lg-9 col-xl-9 site-content">
                <div class="crumbs">
                    {{$this->currentCategory->category['title_'.\Illuminate\Support\Facades\App::currentLocale()]}} > {{$this->currentCategory['title_'.\Illuminate\Support\Facades\App::currentLocale()]}}
                </div>
                <div class="row">
                    @if(count($this->currentCategory->products))
                        @foreach($this->currentCategory->products as $product)
                        <div class="row product-content-row">
                            <div id="{{$product->id}}" class="col-12 col-md-12 col-lg-12 col-xl-12 product-content">
                                <div class="product-content-body col-12">
                                    <div class="row">

                                        <div class="col-12 col-md-12 col-lg-8 col-xl-7 product-text">

                                            @if($product['product_text_'.\Illuminate\Support\Facades\App::getLocale()])
                                                <h1 class="grey">{{$product['title_'.\Illuminate\Support\Facades\App::getLocale()]}}</h1>
                                                <br/>
                                                {!!$product['product_text_'.\Illuminate\Support\Facades\App::getLocale()]!!}
                                            @else
                                                <h1 class="grey">{!!$product['title_nl']!!}</h1>
                                                <br/>
                                                {!!$product['product_text_nl']!!}
                                            @endif
                                            <?php $downloadCount =0?>
                                            @foreach($product->getMedia('files') as $downloads)
                                                @if(str_contains($downloads->mime_type, 'video') || str_contains($downloads->mime_type, 'application'))
                                                        @if($downloadCount == 0)
                                                            <h2 class="grey download-header">Downloads</h2>
                                                        @endif
                                                    <div class="download-links">
                                                        <a class="download-link" target="_blank" href="{{$downloads->getFullUrl()}}">{{$downloads->friendly_name}}</a><br/>
                                                    </div>
                                                <?php $downloadCount++?>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-4 col-xl-5 product-images">
                                            <div id="carouselExampleIndicators{{$product->id}}" class="carousel slide">
                                                <div class="carousel-inner">
                                                        <?php $count = 0;?>
                                                        <?php $count2 = 0;?>

                                                    @foreach($product->getMedia('files') as $files)
                                                        @if(str_contains($files->mime_type, 'image'))
                                                        <div class="carousel-item @if($count == 0) active @endif">
                                                            <img data-remote="{{$files->getFullUrl()}}" data-toggle="lightbox" class="img-fluid" src="{{$files->getFullUrl()}}">
                                                        </div>

                                                            <?php $count ++?>
                                                        @endif

                                                    @endforeach
                                                </div>
                                                <div class="carousel-indicators">

                                                    @foreach($product->getMedia('files') as $files)
                                                        @if(str_contains($files->mime_type, 'image'))
                                                            <button type="button" data-bs-target="#carouselExampleIndicators{{$product->id}}" data-bs-slide-to="{{$count2}}" class="@if($count2 == 0) active @endif thumbnail" @if($count2 == 0) aria-current="true" @endif aria-label="Slide {{$count2+1}}">
                                                                <img src="{{$files->getFullUrl()}}" class="d-block w-100" alt="...">
                                                            </button>
                                                                <?php $count2++?>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        @endforeach
                        @else
                             <div class="row product-content-row ">
                                <div class="col-12 col-md-12 col-lg-12 col-xl-12 no-content">
                                    <div class="product-content-header">
                                        {{__('pages.no-products-title')}}
                                    </div>
                                    <div class="no-content-body col-12">
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
