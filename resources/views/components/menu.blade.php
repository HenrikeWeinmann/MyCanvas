    <div id="myDropdown{{$img->id}}" class="dropdown-content">
        <form class="like" action="{{ route('like_wishlist')  }}" method="post">
            @csrf
             <input type="hidden" id="img_id" name="img_id" value="{{$img->id}}">
            <button type="submit" name="like"  >
            <img class="icon menu-icon"src="/icons/like.svg" alt="My SVG Icon">
         </button>
        </form>
        @if(!$img->sold)
        <form class="cart" action="{{ route('add_to_cart')  }}" method="post">
            @csrf
             <input type="hidden" id="img_id" name="img_id" value="{{$img->id}}">
             <input type="hidden" id="unique" name="unique" value="{{$img->unique}}">
            <button type="submit" name="cart" >
                <img class="icon menu-icon" src="/icons/cart.svg" alt="My SVG Icon">
            </button>
        </form>
        @endif
        <form class="details" action="{{ route('show_details')  }}" method="post">
            @csrf
             <input type="hidden" id="img_id" name="img_id" value="{{$img->id}}">
            <button type="submit" name="details" >
                <img class="icon menu-icon" src="/icons/view.svg" alt="My SVG Icon">
            </button>
        </form>
      </div>
