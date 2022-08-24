    <div id="myDropdown{{$img->id}}" class="dropdown-content">
        @if(!$img->sold)
        <form class="cart" action="{{ route('add_to_guest_cart')  }}" method="post">
            @csrf
             <input type="hidden" id="img_id" name="img_id" value="{{$img->id}}">
            <button type="submit" name="cart" >
                <img class="icon menu-icon" src="/icons/cart.svg" alt="My SVG Icon">
            </button>
        </form>
        @endif
        <form class="details" action="{{ route('guest_show_details')  }}" method="post">
            @csrf
             <input type="hidden" id="img_id" name="img_id" value="{{$img->id}}">
            <button type="submit" name="details" >
                <img class="icon menu-icon" src="/icons/view.svg" alt="My SVG Icon">
            </button>
        </form>
      </div>
