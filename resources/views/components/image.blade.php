<div class="image">
        <p class="sold-banner sold{{$img->sold}}">sold sold sold</p>
        <img class="img sold{{$img->sold}}" id="img{{$img->id}}" src="/images/{{$img->image_path}}" title="{{$img->title}}"onclick="menu({{$img->id}})">
        <div class="image-bottom">
            <figcaption class="subtitle">{{$img->title}}</figcaption>
            <img class="icon like_heart" id="like_heart{{$img->id}}"src="/icons/like.svg" alt="My SVG Icon">
        <script type="text/javascript">
        function toggle_like(id,wishlist) {
            if (wishlist.includes(id)) {
                document.getElementById("like_heart"+id).style.display = "block";
            }
        }
        toggle_like({{$img->id}},{{$liked}});
        </script>
        </div>
    {{$slot}}
</div>
