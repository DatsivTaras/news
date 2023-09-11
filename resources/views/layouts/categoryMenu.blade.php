<div class="app-menu-container">
    <ul>
        <li><a class="{{ \Illuminate\Support\Facades\Route::getCurrentRoute()->uri == '/'  ? 'active' : '' }}" href="{{route('/')}}">@lang('main.home')</a></li>
        @foreach(\App\Services\HomeServices::getCategoryMainMenu() as $category)
            <li><a class="{{ \Illuminate\Support\Facades\Route::getCurrentRoute()->uri == 'category/{category}' && \Illuminate\Support\Facades\Route::getCurrentRoute()->parameters['category'] == $category->slug ? 'active' : '' }}" href={{ $category->getUrl() }}>{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>
