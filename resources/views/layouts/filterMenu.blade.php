<div class="news-menu-container">
    <ul>
        <form  method="get" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <input type="hidden" name="query" value="{{ request()->get('query') }}">
            <div class="input-group">
                <li class="news-menu-item active"><button class="btn" name="type" value="last">Останнє</button></li>
                <li class="news-menu-item"><button class="btn" name="type" value="main">Головне</button></li>
                <li class="news-menu-item"><button class="btn" name="type" value="popular">Популярне</button></li>
            </div>
        </form>
    </ul>
</div>
