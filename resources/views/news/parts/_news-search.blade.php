@foreach ($news as $new)
    <div class="col-sm-12 search-news-blocks">
            <div class="card">
                <div class="three-news-blocks-category">
                    <div class="triangle">
                        <a href="{{ $new->getCategory()->getUrl() }}">
                            {{ $new->getcategoryName() }}
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <img class="card-img-top" src="{{ $new->getImageUrl() }}" alt="Card image cap">
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{$new->getUrl()}}">{{ $new->title }}</a>
                            </h5>
                            <p class="card-text">{{ $new->mini_description }}</p>
                            <div class="read-more-container">
                                <p class="read-more"> <a href="{{$new->getUrl()}}">Читти > </a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach
