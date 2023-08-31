<div style="text-align: center;background-color: white;">
    <ul style="padding: 10px 0px 10px 0px; margin-bottom: 0px; font-size: 20px;border-top:1px solid black; border-bottom:1px solid black">
        <li style="display: inline; padding-left: 10px"><a href="{{route('/')}}">@lang('main.home')</a></li>
        @foreach(\App\Services\HomeServices::getCategoryMainMenu() as $category)
            <li style="display: inline; padding-left: 10px"><a href={{ $category->getUrl() }}>{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>
