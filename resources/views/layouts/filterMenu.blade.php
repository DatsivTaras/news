<div style="text-align: center;background-color: white;">
    <ul style="padding: 10px 0px 10px 0px; margin-bottom: 0px; font-size: 20px;border-top:1px solid black; border-bottom:1px solid black">
        <form  method="get" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <input type="hidden" name="query" value="{{ request()->get('query') }}">
            <div class="input-group">
                <li style="display: inline; padding-left: 10px"><button class="btn" name="type" value="last">Останнє</button></li>
                <li style="display: inline; padding-left: 10px"><button class="btn" name="type" value="main">Головне</button></li>
                <li style="display: inline; padding-left: 10px"><button class="btn" name="type" value="popular">Популярне</button></li>
            </div>
        </form>
    </ul>
</div><br>
