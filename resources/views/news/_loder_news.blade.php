<div class="col-sm-12">
    <div class="row">
        <h1 class="text-center">
            {{$news->getTitle()}}
            <div class="category">
                <img class="card-img-top" src="{{ $news->getImageUrl() }}" width="200" height="600" alt="Card image cap">
                <div style="background-color:coral "class="top-left">{{ $news->getCategoryName() }}</div>
            </div>
        </h1>
        <div class="row">
            <i>{{ $news->getPublicationDate() }}</i>
        </div>
        <div class="row">
            {!! $news->getDescription() !!}
        </div>
        @if($author = $news->getAuthor())
            <div class="row">
                <div align="ceter">Автор: <a href= {{ $author->getUrl() }} }}>{{ $author->getFullName() }}</a></div>
            </div><br><br>
        @endif

        <div class="row">
            <div class="btn-group">
                {{ 'Теги :' }}
                @foreach($news->tags as $tag)
                    <div class="btn-group me-2" role="group" aria-label="Second group">
                        <a href='/search?query={{ $tag->name }}'>{{ $tag->name .' '}}  </a>
                    </div>
                @endforeach
            </div>
        </div>
