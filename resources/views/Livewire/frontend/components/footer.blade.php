
<div class="footer">
    <div class="container footer-container">
        <div class="footer-inner">
            <div class="footer-box footer-box-left">
                <img alt="Crewa logo" class="footer-logo" src="{{asset('/storage/images/frontend/logo-gold-white.png')}}"/>
                <div class="footer-text">
                   <div class="adres">
                        <div class="adres-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                       <div class="adres-details">
                            <a target="_blank" href="https://maps.app.goo.gl/k8spNgsV4i5fwZV58">
                            Hulstweg 24 BIS<br/>
                            3774TM Kootwijkerbroek
                            </a>
                       </div>
                   </div>
                    </p>
                </div>
                <div class="footer-icons">
                    <p><i class="fa-solid fa-phone-volume"></i><a href="tel:0631933506">06 - 31 93 35 06</a></p>
                    <p><i class="fa-regular fa-envelope"></i><a href="mailto:info@crewa.nl">INFO@CREWA.NL</a></p>
                </div>
            </div>
            <div class="footer-box footer-box-right">
                <h3><span class="color-white">Sitemap</span></h3>
                <div class="stripe"></div>
                <ul class="footer-menu-items" style="list-style: none">
                   @foreach($menu_items as $item)
                    <li><a href="{{$item->pages->route}}">{{$item->title}}</a></li>

                   @endforeach
                </ul>

                <h3><span class="color-white">Beoordelingen</span></h3>
                <div class="stripe"></div>
                <div data-romw-token="EVz59qfBrAHojum6yfktobB4vhZ0JEgo9hEwNia6bumWFz3z7R"></div>
                <script src="https://reviewsonmywebsite.com/js/v2/embed.js?id=7bf8acda5d5930b1a9db343a4ec1b31c" type="text/javascript"></script>
                <a href="https://www.google.com/search?sa=X&sca_esv=0dcc3d4151cae03d&rlz=1C1CHBD_nlNL1082NL1082&hl=nl-NL&tbm=lcl&q=Crews%20Reviews&rflfq=1&num=20&stick=H4sIAAAAAAAAAONgkxI2NjG3MDExMDc1t7A0NDU2NzUz28DI-IqR17kotbxYISi1LBNIL2JF5QMAKHagXjoAAAA&rldimm=3478440757891537566&ved=0CAsQ5foLahcKEwjwvJ-Ewc6EAxUAAAAAHQAAAAAQBQ&biw=1745&bih=859&dpr=1.1#lkt=LocalPoiReviews&arid=ChZDSUhNMG9nS0VJQ0FnSURkajhDZFNnEAE">Lees meer reviews...</a>

            </div>
        </div>

        <div class="footer-line col-md-12">
            <p>Crewa | 2024</p>
        </div>
    </div>
</div>
