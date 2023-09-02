<div class="app-menu-container">
    <ul>
        <li><a class="active" href="{{route('/')}}">@lang('main.home')</a></li>
        @foreach(\App\Services\HomeServices::getCategoryMainMenu() as $category)
            <li><a href={{ $category->getUrl() }}>{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>
