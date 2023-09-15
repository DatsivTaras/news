@foreach ($news as $new)
    @if(empty($date))
        @php {{ $date = $new->date_of_publication; }} @endphp
        <p data-date="{{ $date }} " class="date-news">{{\Carbon\Carbon::parse($date)->day . ' ' . \App\Helpers\DateHelper::getMonth()[\Carbon\Carbon::parse($date)->format('M')] }}</p>
    @endif

    @if((\Carbon\Carbon::parse($date)->format('Y-m-d')  != \Carbon\Carbon::parse($new->date_of_publication)->format('Y-m-d')))
        @php {{ $date = $new->date_of_publication; }} @endphp
        <p data-date="{{ $date }} " class="date-news">{{\Carbon\Carbon::parse($date)->day . ' ' . \App\Helpers\DateHelper::getMonth()[\Carbon\Carbon::parse($date)->format('M')] }}</p>
    @endif
    <div class="col-sm-12 three-news-blocks main-news">
        <a href="{{$new->getUrl()}}" style="text-decoration: none; color:black">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">17.04.1992 {{ $new->title }}</h5>
                </div>
            </div>
        </a>
    </div>
@endforeach
