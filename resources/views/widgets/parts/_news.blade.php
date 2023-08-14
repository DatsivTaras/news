<a href="{{$news->getUrl()}}" style="text-decoration: none; color:#131313">
    <div {{$news->getNewsType() ? 'style=font-weight:bold' : '' }}>
        <p>{{$news->getTitle()}}</p>
        <i>{{ $news->getPublicationDate() }}</i>
    </div>
</a>
