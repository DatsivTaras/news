<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', getSetting('site_name')) }}</title>

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
<body>
    <nav>
        <input type="checkbox" id="menu" name="menu" class="m-menu__checkbox">
        <label class="m-menu__toggle" for="menu">
            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </label>
        <div class="logo-image" style="width: 100%; max-height: 40px; border-radius:0px">
            <img src="{{ Storage::url(\App\Services\SettingServices::getHeaderLogo()) }}" class="img-fluid" width="300" height="41" >
            <form action="{{ route('search')  }}" method="get" style="float: right">
                <div class="input-group">
                    <input name="query" class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>

        <label class="m-menu__overlay" for="menu"></label>
        <div class="m-menu">
            <div class="m-menu__header">
                <label class="m-menu__toggle" for="menu">
                    <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </label>
                <span></span>
            </div>
            <ul style="padding-left: 0px;">
                <li style="list-style-type: none;"><label><a href="/">Головна</a></label></li>
                @foreach(\App\Services\CategoryServices::getCategoryHeaderMenu() as $category)
                    <li style="list-style-type: none;"><label><a href={{ '/category/'.$category->slug }}>{{$category->name}}</a></label></li>
                @endforeach
            </ul>
        </div>
    </nav>
    
    <div class="wrapper">
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
                @include('layouts.footer')
            </main>
        </div>
    </div>
</body>
</html>
