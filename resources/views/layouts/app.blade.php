<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link style="height:20px" rel="icon" type="image/x-icon" href="{{ asset('/img/KD-Logo.ico') }}">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ getSetting('site_name') ?? config('app.name')  }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="{{ asset("/css/app.css") }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('meta_tags')
    </head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SYYQ5EWE81"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-SYYQ5EWE81');
    </script>
    <body class="{{ app(\Illuminate\Routing\Route::class)->getActionMethod() == 'contacts' ? 'contact-bg' : ''  }}">
    <div class="container">

        <header>
            <section class="top-bar mobile-hide">
                <div class="custom-container">
                    <div class="left-side">
                        <span><img src="{{ asset('/img/map_marker.png') }}">{{ getSetting('address') }}</span>
                    </div>
                    <div class="right-side">
                        <div class="top-bar-email">
                            <a href="mailto:{{ getSetting('email_address') }}"><img src="{{ asset('/img/email_icon.png') }}">{{ getSetting('email_address') }}</a>
                        </div>
                        <div class="top-bar-phone">
                            <a href="tel:{{ getSetting('phone') }}"><img src="{{ asset('/img/Phone_icon.png') }}">{{ getSetting('phone') }}</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="main-header">
                <div class="main-header-container">
                    <div class="main-header-left-side">
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                          </button>
                          <ul class="dropdown-menu">
                              <div class="main-menu-container">
                                  <div class="menu-category">
                                      <span class="menu-category-title">ВСІ КАТЕГОРІЇ </span>
                                      @foreach(\App\Services\HomeServices::getCategoryLeftMenu() as $category)
                                          <li><a class="menu-dropdown-item" href={{ '/category/' . $category->slug }}>{{ $category->name }}</a></li>
                                      @endforeach
                                  </div>
                                  <div class="menu-category menu-sub-category">
                                      <span class="menu-category-title">ПОПУЛЯРНЕ</span>
                                      <div class="tag-conteiner">
                                          @foreach(\App\Services\HomeServices::getTopTags() as $tag)
                                              <a class="menu-dropdown-item" href="{{ '/search?query='.$tag->name}}">{{ $tag->name }}</a>
                                          @endforeach
                                      </div>

                                  </div>
                              </div>

                          </ul>
                        </div>
                       <!-- <div class="chose-lang">
                            <a class="language active" href="/">UA</a>
                            <a class="language" href="/">EN</a>
                        </div> -->
                    </div>
                    <div class="main-header-center">
                        <a href="/"><img src="{{ asset('/img/KD-Logo-UA-FIN-01.png')}} "></a>
                    </div>
                    <div class="main-header-right-side">
                        <form action="{{ route('search')  }}" method="get" style="float: right">
                            <div class="input-group header-search">
                                <input name="query" class="form-control search-input" type="text" placeholder="магате...." aria-label="магате...." aria-describedby="btnNavbarSearch" />
                                <span class="search-show"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section class="app-menu">
                @include('layouts.categoryMenu')
            </section>
        </header>

        <section class="main">
            <div class="wrapper">
                <main>
                    @yield('content')
                </main>
            </div>
        </section>

        @include('layouts.footer')
    </body>
    <script>
        $(document).ready(function(){
          $( ".search-show" ).on( "click", function() {
            $(".header-search").toggleClass("show");
          } );
        });
    </script>
</html>
