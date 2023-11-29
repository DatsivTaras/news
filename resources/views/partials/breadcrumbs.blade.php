@unless ($breadcrumbs->isEmpty())
    <ol class="breadcrumb mobile-hide">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <img class="back-home-icon" src="{{ asset('/img/home-img.png') }}" alt="">
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>
@endunless