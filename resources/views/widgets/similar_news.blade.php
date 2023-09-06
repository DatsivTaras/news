@foreach ($news as $new)
    <div class="col-sm-4">
        <a href="{{$new->getUrl()}}" style="text-decoration: none; color:black">
            <div class="card">
                <img class="card-img-top" src="{{ $new->getImageUrl() }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $new->title }}</h5>
                    <p class="card-text">{{ $new->mini_description }}</p>
                    <b>Джерело :</b> {{ $new->subtitle }}
                </div>
            </div>
        </a>
    </div>
@endforeach
