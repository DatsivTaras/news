@foreach ($news as $new)
    <div class="col-sm-4 three-news-blocks">
        <a href="{{$new->getUrl()}}" style="text-decoration: none; color:black">
            <div class="card">
                <div class="three-news-blocks-category"><div class="triangle">{{ $new->getcategoryName() }}</div></div>
                <img class="card-img-top" src="{{ $new->getImageUrl() }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $new->title }}</h5>
<!--                     <p class="card-text">{{ $new->mini_description }}</p> -->
                    <p class="source"><b>Джерело :</b> {{ $new->subtitle }}</p>
                    <a class="read-more" href="{{$new->getUrl()}}">Далі > </a>
                </div>
            </div>
        </a>
    </div>
@endforeach
