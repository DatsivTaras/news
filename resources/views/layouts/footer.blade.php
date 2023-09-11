<div class="container-fluid" style="margin-top: 0px">
    <hr class="mx-0 px-0">
    <footer>
        <div class="row justify-content-around mb-0 pt-5 pb-0 ">
            <div class=" col-11">
                <div class="row justify-content-center">
                    <div class="col-md-3 col-12 font-italic align-items-center mt-md-3 mt-4">
                        <div class="footer-logo-container">
                            <a href="/"><span><img src="{{ asset('/img/footer-logo.png')}} ">КОРОЛЬ ДАНИЛО</span></a>
                        </div>
                      <!--  <img class='imgfooter' src="{{ Storage::url(\App\Services\SettingServices::getFooterLogo()) }}"  width="159" height="41" class="img-fluid mb-1 "> -->
                        <p class="social mt-md-3 mt-2">
                            @if($facebookLink = getSetting('facebook_link'))
                                <a href="{{ $facebookLink }}" style="text-decoration: none !important;">
                                    <span class="social-icon"><i class="fa fa-facebook" aria-hidden="true"></i></span>
                                </a>
                            @endif

                            @if($twitterLink = getSetting('twitter_link'))
                                <a href="{{ $twitterLink }}" style="text-decoration: none !important;">
                                    <span class="social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></span>
                                </a>
                            @endif

                            @if($youtubeLink = getSetting('youtube_link'))
                                <a href="{{ $youtubeLink }}" style="text-decoration: none !important;">
                                    <span class="social-icon"><i class="fa fa-youtube" aria-hidden="true"></i></span>
                                </a>
                            @endif

                            @if($telegramLink = getSetting('telegram_link'))
                                <a href="{{ $telegramLink }}" style="text-decoration: none !important;">
                                    <span class="social-icon"><i class="fa fa-telegram" aria-hidden="true"></i></span>
                                </a>
                            @endif

                            @if($instagramLink = getSetting('instagram_link'))
                                <a href="{{ $instagramLink }}" style="text-decoration: none !important;">
                                    <span class="social-icon"><i class="fa fa-instagram" aria-hidden="true"></i></span>
                                </a>
                            @endif

                            @if($tiktokLink = getSetting('tiktok_link'))
                                <a href="{{ $tiktokLink }}" style="text-decoration: none !important;">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                                    </span>
                                </a>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-3 col-4 my-sm-0 mt-5 footer-menu-container">
                        <ul class="list-unstyled">
                            <li class="mt-md-3 mt-4 footer-menu-title">Категорії</li>
                            @if($footerCategories = \App\Services\CategoryServices::getFooterCategories())
                                @foreach($footerCategories as $category)
                                    <li>
                                        <a href="{{ $category->getUrl() }}" style="text-decoration: none !important;">
                                            {{ $category->getName() }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-3 col-4 my-sm-0 mt-5 footer-menu-container">
                        <ul class="list-unstyled">
                            <li class="mt-md-3 mt-4">
                                <a href="/page/testova_storinka" style="text-decoration: none !important;">Про нас</a>
                            </li>
                            <li>
                                <a href="/page/testova_storinka" style="text-decoration: none !important;">Редакція</a>
                            </li>
                            <li>
                                <a href="/page/testova_storinka" style="text-decoration: none !important;">Редакційна політика</a>
                            </li>
                            <li>
                                <a href="/page/testova_storinka" style="text-decoration: none !important;">Автори</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-auto col-md-3 col-4 my-sm-0 mt-5 footer-menu-container">
                        <ul class="list-unstyled">
                            <li class="mt-md-3 mt-4">
                                <a href="/page/testova_storinka" style="text-decoration: none !important;">Контакти</a>
                            </li>
                            <li>
                                <a href="/page/testova_storinka" style="text-decoration: none !important;">Політика конфеденційності</a>
                            </li>
                            <li>
                                <a href="/page/testova_storinka" style="text-decoration: none !important;">Технічна інформація</a>
                            </li>
                            <li>
                                <a href="/page/testova_storinka" style="text-decoration: none !important;">Правила кофіденційності</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div align="center"  class="copy-rights cursor-pointer">&#9400; {{ now()->format('Y') }} {{ getSetting('site_name') }}.Усі права захищено. </div>
    </footer>
</div>

<div class="b-example-divider"></div>
</div>
