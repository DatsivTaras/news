<div class="col-sm-12">
<div class="loader-end-block"></div>
    <div class="row single-news-container">
        <div class="category">
            <img class="card-img-top" src="{{ $news->getImageUrl() }}"alt="Card image cap">
            <div class="top-left"><div class="triangle">{{ $news->getCategoryName() }}</div></div>
        </div>
        <h1 class="single-news-title">
            {{$news->getTitle()}}
        </h1>
       <!-- <div class="row">
            <i>{{ $news->getPublicationDate() }}</i>
        </div> -->
        @if($author = $news->getAuthor())
            <div class="row single-news-author">
                <i>Автор: <b><a href= {{ $author->getUrl() }} }}>{{ $author->getFullName() }}</a></b></i>
            </div><br><br>
        @endif
        <div class="row single-news-description">
            {!! $news->getDescription() !!}
        </div>
        <div class="row single-news-tags">
            <div class="btn-group">
                {{ 'Теги :' }}
                @foreach($news->tags as $tag)
                    <div class="btn-group me-2" role="group" aria-label="Second group">
                    <a href='/search?query={{ $tag->name }}'>{{ $tag->name .' '}}  </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
