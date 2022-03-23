<a href="" class="dropdown-toggle cart-icon" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="tf-ion-android-cart"></i>

    @if(Session::has('cart'))
    <sup class="nav-box-number">{{ count(Session::get('cart'))}}</sup>
    @else
    <sup class="nav-box-number">0</sup>
    @endif
</a>
<div class="dropdown-menu cart-dropdown">
    @if(Session::has('cart'))
        @if(count($cart = Session::get('cart')) > 0)
        
            @php
                $total = 0;
            @endphp
            @foreach($cart as $key => $cartItem)
                @php
                    $product = \App\Product::find($cartItem['id']);
                    $total = $total + $cartItem['price']*$cartItem['quantity'];
                @endphp
                <div class="media">
                    <a href="{{ route('product', $product->slug) }}">
                        @if (!empty($product->thumbnail_img))
                            @if(file_exists($product->thumbnail))
                                <img class="media-object img- mr-3" src="{{asset($product->thumbnail_img)}}" alt="{{$product->name}}">
                            @else
                                <img class="media-object img- mr-3" src="{{asset('frontend/images/placeholder.jpg')}}" alt="{{$product->name}}">
                            @endif
                        @else
                            <img class="media-object img- mr-3" src="{{asset('frontend/images/placeholder.jpg')}}" alt="{{$product->name}}">
                        @endif
                    </a>
                    <div class="media-body">
                        <h6>{{$product->name}}</h6>
                        <div class="cart-price">
                            <span>{{ $cartItem['quantity'] }} x</span>
                            <span>{{ single_price($cartItem['price']) }}</span>
                        </div>
                    </div>
                    <a class="remove" title="Remove" onclick="removeFromCart({{ $key }})" style="cursor: pointer"><i class="tf-ion-close"></i></a>
                </div>
            @endforeach
            <div class="cart-summary">
                <span class="h6">Total</span>
                <span class="total-price h6">{{ single_price($total) }}</span>
                <div class="text-center cart-buttons mt-3">
                    <a href="{{ route('cart') }}" class="btn btn-small btn-transparent btn-block">View Cart</a>
                    @if (Auth::check())
                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-small btn-main btn-block">Checkout</a>
                    @endif
                </div>
            </div>
        @else
        <div class="media">
            <span class="h6">Your Cart Is Empty</span>
        </div>
        @endif
    @else
        <div class="media">
            <span class="h6">Your Cart Is Empty</span>
        </div>
    @endif
</div>
