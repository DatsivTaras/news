@foreach ($news as $new)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 three-news-blocks">
            <div class="card">
                <div class="three-news-blocks-category">
                    <div class="triangle">
                        <a class="category-link" href="#">{{ $new->getcategoryName() }}</a>
                    </div>
                </div>
                <img class="card-img-top" src="{{ $new->getImageUrl() }}" alt="Card image cap">
                <div class="card-body">
                    <a href="{{$new->getUrl()}}"><h5 class="card-title">{{ $new->title }}</h5></a>
<!--                     <p class="card-text">{{ $new->mini_description }}</p> -->
                    <p class="source"><b>Джерело :</b> {{ $new->subtitle }}</p>
                    <div class="read-more-container">
                        <a href="{{$new->getUrl()}}">
                            <p class="read-more">Далі > </p>
                        </a>
                        <p class="date-news">{{ \Carbon\Carbon::parse($new->date_of_publication)->format('d.m.Y') }}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach
