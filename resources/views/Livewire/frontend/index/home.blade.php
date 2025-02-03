<div>
    <div class="container">

        <div class="row">
            @include('livewire.frontend.components.sideMenu')

            <div class="col-12 col-md-12 col-lg-8 col-xl-9 col-xxl-10 site-content">
                <div class="row home-content-row ">

                    <div class="col-12 col-md-12 col-lg-12 col-xl-6 home-content">
                        @foreach($this->pageBlocks as $key => $blocks)

                                <?php $blockNames = \App\Models\Block::where('id', $blocks->block_id)->get();?>

                            @if($blockNames[0]['table_name'] == 'text_block')
                                @include('Livewire.Blocks.'.$blockNames[0]['block_name'].'.frontend.index', ['blocks' => $blocks])
                            @endif
                        @endforeach

                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-6 home-content-image-box">
                        @foreach($this->pageBlocks as $key => $blocks)

                                <?php $blockNames = \App\Models\Block::where('id', $blocks->block_id)->get();?>

                            @if($blockNames[0]['table_name'] == 'image_block')
                                @include('Livewire.Blocks.'.$blockNames[0]['block_name'].'.frontend.index', ['blocks' => $blocks])
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="row categories-content">
                @if($subcategories)
                    <h3>{{__('pages.category')}}</h3>
                    @foreach($subcategories as $category)

                        <div class="card col-12 col-sm-6 col-md-6 col-xl-3">
                            <div class="inner-card">
                                <div class="card-header">
                                    @if($category['title_'.\Illuminate\Support\Facades\App::currentLocale()] == '')
                                        <h4>{!! $category['title_nl']!!}</h4>
                                    @else
                                        <h4>{!! $category['title_'.\Illuminate\Support\Facades\App::currentLocale()]!!}</h4>
                                    @endif
                                </div>

                                @foreach($category->getMedia('tumbnail') as $media)
                                    @if($media)
                                        <div class="card-image-box" style="background-image:url('{{$media->getFullUrl()}}');"></div>
                                    @else
                                        <div class="card-image-box" style="background-image:url('/storage/images/frontend/kuilbak_s-80-80-250-1.jpg');"> </div>
                                   @endif
                                @endforeach



                                <div class="card-body">
                                    @if($category['title_'.\Illuminate\Support\Facades\App::currentLocale()] == '')
                                        <h4 class="card-title">{!! $category['title_nl']!!}</h4>
                                    @else
                                        <h4 class="card-title">{!! $category['title_'.\Illuminate\Support\Facades\App::currentLocale()]!!}</h4>
                                    @endif
                                    <div class="card-text">


                                        @if($category['subCategory_text_'.\Illuminate\Support\Facades\App::currentLocale()] == '')

                                            {!! $category['subCategory_text_nl']!!}
                                        @else
                                            {!! $category['subCategory_text_'.\Illuminate\Support\Facades\App::currentLocale()]!!}
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="/{{\Illuminate\Support\Facades\App::getLocale().'/'.$category->category->route.'/'.$category->route}}" class="btn btn-outline-secondary">
                                        {{__('pages.cardbutton')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>



