<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset("/css/css.css") }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/admin">Адмін панель</a>
    <!-- Sidebar Toggle-->
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    @guest

        @if (Route::has('login'))
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
                <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        </ul>
    @endguest

</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="/admin">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Головна
                    </a>
                    <a class="nav-link" href="/admin/categories">
                        <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                        Категорії
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Новини
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/admin/news">Опубліковані</a>
                            <a class="nav-link" href="/admin/news/drafts">Черновики</a>
                            <a class="nav-link" href="/admin/news/basket">Кошик</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="/admin/sliders">
                        <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                        Слайдер
                    </a>
                    <a class="nav-link" href="/admin/authors">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>
                        Автори
                    </a>
                    <a class="nav-link" href="/admin/pages">
                        <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                        Сторінки
                    </a>
                    <a class="nav-link" href="/admin/settings">
                        <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                        Налаштуванння
                    </a>
                    <a class="nav-link" href="/admin/users">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Користувачі
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @yield('content')
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>


