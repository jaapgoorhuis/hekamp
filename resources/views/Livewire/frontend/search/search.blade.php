<div>
    <div class="container">
        <div class="row">
            @include('livewire.frontend.components.sideMenu')
            <div class="col-12 col-md-8 col-xl-10 site-content">

                <div class="row">
                        <div class="row product-content-row ">
                            <div class="col-12 col-md-12 col-lg-12 col-xl-12 product-content">
                                <div class="product-content-header">
                                    {{__('pages.searchResults')}}
                                </div>
                                    <div class="product-content-body col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                                <ul>
                                                    @if(count($this->foundedProducts))
                                                        @foreach($this->foundedProducts as $result)
                                                            <li><a class="search-results" href="/{{\Illuminate\Support\Facades\App::getLocale().'/'.$result->subCategories->category->route.'/'.$result->subCategories->route.'#'.$result->id}}">{{$result->title_nl}}</a></li>
                                                        @endforeach
                                                    @else
                                                        <p>
                                                            {{__('pages.no-search-results')}}
                                                        </p>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
