
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <h2>{{__('pages.pages')}}</h2>
                <ul class="footer-items">
                    @foreach(\App\Models\MenuItems::orderBy('order_id', 'asc')->where('show_footer', '1')->get() as $item)
                        @if($item->page)
                         <li><a href="/{{$item->page->route}}">

                                 @if( $item['title_'.\Illuminate\Support\Facades\App::currentLocale()] == '')
                                     {{$item['title_nl']}}
                                 @else
                                     {!! $item['title_'.\Illuminate\Support\Facades\App::currentLocale()]!!}
                                 @endif
                        </a></li>
                        @endif
                    @endforeach

                </ul>
            </div>
            <div class="col-12 col-md-4">
                <h2>{{__('pages.downloads')}}</h2>
                <ul class="footer-items">
                    @foreach($downloads as $key => $media)
                    <li><a data-bs-toggle="modal" data-bs-target="#exampleModal{{$key}}">{{$media->friendly_name}}</a></li>
                        <!-- Modal -->
                        <div class="modal fade modal-xl" id="exampleModal{{$key}}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <iframe class="responsive-iframe" src=" {{$media->getFullUrl()}}"></iframe>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </ul>


            </div>
            <div class="col-12 col-md-4">
                <h2>{{__('pages.contact_details')}}</h2>
                <ul class="footer-items">
                    <li>{{$site_settings->site_name}}</li>
                    <li>{{$site_settings->address}}</li>
                    <li>{{$site_settings->zipcode}} {{$site_settings->town}} </li>
                    <li>{{$site_settings->province}}</li>
                    @if($site_settings->phone)
                        <li><a href="tel:{{$site_settings->phone}}"><i class='bx bx-phone'></i> {{$site_settings->phone}}</a></li>
                    @endif
                    @if($site_settings->mobile_phone)
                        <li><a href="tel:{{$site_settings->mobile_phone}}"><i class='bx bx-mobile-alt'></i> {{$site_settings->mobile_phone}}</a></li>
                    @endif
                    @if($site_settings->email)
                        <li><a href="mailto:{{$site_settings->email}}"><i class='bx bx-envelope'></i> {{$site_settings->email}}</a></li>
                    @endif
                    @if($site_settings->second_email)
                        <li><a href="mailto:{{$site_settings->second_email}}"><i class='bx bx-envelope' ></i> {{$site_settings->second_email}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

</div>


