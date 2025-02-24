<div>
    <div class="container">
        <div class="row">
            @include('livewire.frontend.components.sideMenu')
            <div class="col-12 col-md-12 col-lg-9 col-xl-9 site-content">
                <div class="row">
                    <div class="row product-content-row ">
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12 no-content">
                            <div class="product-content-header">
                                {{__('pages.products')}}
                            </div>
                            <div class="no-content-body col-12">
                                @if(count($this->foundedProducts))
                                    @foreach($this->foundedProducts as $result)
                                        <li>
                                            <a class="search-results" href="/{{\Illuminate\Support\Facades\App::getLocale().'/'.$result->subCategories->category->route.'/'.$result->subCategories->route.'#'.$result->id}}">
                                                @if( $result['title_'.\Illuminate\Support\Facades\App::currentLocale()] == '')
                                                    {{$result['title_nl']}}
                                                @else
                                                    {!! $result['title_'.\Illuminate\Support\Facades\App::currentLocale()]!!}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <p>
                                        {{__('pages.no-search-results')}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
