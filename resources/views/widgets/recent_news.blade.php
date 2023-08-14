<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Останнє
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Головне
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                role="tab" aria-controls="contact" aria-selected="false">Популярне
        </button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
        @if ($lastNews)
            @foreach($lastNews as $news)
                @include('widgets.parts._news', compact('news'))
                <hr>
            @endforeach
        @else
            <p>Відсутні</p>
        @endif
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @if($popularNews)
            @foreach($mainNews as $news)
                @include('widgets.parts._news', compact('news'))
                <hr>
            @endforeach
        @else
            <p>Відсутні</p>
        @endif
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        @if ($popularNews)
            @foreach($popularNews as $news)
                @include('widgets.parts._news', compact('news'))
                <hr>
            @endforeach
        @else
            <p>Відсутні</p>
        @endif
    </div>
</div>

