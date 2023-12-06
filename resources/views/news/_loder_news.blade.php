<div class="col-sm-12">
<div class="loader-end-block"></div>
    <div class="row single-news-container">
        <div class="category">
            <img class="card-img-top" src="{{ $news->getImageUrl() }}"alt="Card image cap">
            <div class="top-left"><div class="triangle">{{ $news->getCategoryName() }}</div></div>
        </div>
        <div class="singl-news-body">
            <h1 class="single-news-title">
                {{$news->getTitle()}}
            </h1>
            @if($author = $news->getAuthor())
                <div class="row single-news-author">
                    <i>Автор: <b><a href= {{ $author->getUrl() }} > {{ $author->getFullName() }}</a></b></i>
                </div>
                <div class="row d-lg-none d-xl-none">
                    <div id="social-links">
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $news->getUrl() }}" class="social-button " id="" title="" rel="">
                                <span class="social-icon"><i class="fa fa-facebook" aria-hidden="true"></i></span>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?text=fd&amp;url={{ $news->getUrl() }}" class="social-button " id="" title="" rel="">
                                    <span class="social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://telegram.me/share/url?url={{ $news->getUrl() . '&text=' . $news->getTitle() }}" class="social-button " id="" title="" rel="">
                                    <span class="social-icon"><i class="fa fa-telegram" aria-hidden="true"></i></span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="mailto:news-demo.space?subject={{$news->getTitle() }}&amp;body={{ $news->getUrl() }}" data-provider="" data-share-link="{{ $news->getUrl() }}" data-share-title="{{ $news->getTitle() }}" class="social-button " id="" title="" rel="">
                                    <span class="social-icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                </a>
                            </li>
                            <li>
                                <a class="social-button" id="copy-link" title="" rel="">
                                    <span class="social-icon"><i class="fa fa-clone" aria-hidden="true"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
            <div class="row single-news-description">
                {!! $news->getDescription() !!}
            </div>
        </div>

        <div class="row single-news-tags">
            <div class="btn-group">
                {{ 'Теги :' }}
                @foreach($news->tags as $tag)
                    <div class="btn-group me-2" role="group" aria-label="Second group">
                    <a href='/search?query={{ $tag->name }}'>{{ mb_strtoupper($tag->name) . ' '}}  </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="fb-root"></div>
        <div class="fb-comments" data-href="{{ $news->getUrl() }}" data-width="100%" data-numposts="5"></div>
    </div>
    
