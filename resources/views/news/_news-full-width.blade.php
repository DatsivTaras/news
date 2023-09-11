@foreach ($news as $new)
    <div class="col-sm-12 three-news-blocks">
        <a href="{{$new->getUrl()}}" style="text-decoration: none; color:black">
            <div class="card">
                <div class="card-body">
                    <h5    class="card-title">17.04.1992 {{ $new->title }}</h5>
                </div>
            </div>
        </a>
    </div>
@endforeach
