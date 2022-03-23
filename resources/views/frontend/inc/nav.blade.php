<nav class="navbar navbar-expand-lg navbar-light bg-white w-100 navigation" id="navbar">
    <div class="container">
        <a class="navbar-brand font-weight-bold p-0" href="{{route('home')}}">
            @php
                $generalsetting = \App\GeneralSetting::first();
            @endphp
            @if($generalsetting->logo != null)
                <img src="{{ asset($generalsetting->logo) }}" class="img-fluid" alt="{{ env('APP_NAME') }}">
            @else
                <img src="{{ asset('frontend/assets/images/logo.png') }}" class="img-fluid" alt="{{ env('APP_NAME') }}">
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar"
            aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="main-navbar">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About Us</a>
                </li>
                <!-- Pages -->
                <li class="nav-item dropdown dropdown-slide">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-delay="350"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pages.
                    </a>
                    <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown4">
                        <li class="dropdown-custom-right"> <a>
                                Categories
                            </a>
                            <ul class="custom-dropdown bg-light">
                                <li><a href="">Categories 1</a></li>
                                <li><a href="">Categories 2</a></li>
                                <li><a href="">Categories 3</a></li>
                                <li><a href="">Categories 4</a></li>
                                <li><a href="">Categories 5</a></li>
                            </ul>
                        </li>
                    </ul>
                </li><!-- /Pages -->
                <!-- / Blog -->
                <li class="nav-item dropdown dropdown-slide">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-delay="350"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Shop.
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                        <li><a href="shop-sidebar.html">Shop</a></li>
                        <li><a href="product-single.html">Product Details</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="cart.html">Cart</a></li>
                    </ul>
                </li><!-- / Blog -->
                <!-- Account -->
                <li class="nav-item dropdown dropdown-slide">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown5" role="button" data-delay="350"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account.
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown5">
                        <li><a href="dashboard.html">Dashboard</a></li>
                        <li><a href="login.html">Login Page</a></li>
                        <li><a href="signup.html">SignUp Page</a></li>
                        <li><a href="forgot-password.html">Forgot Password</a></li>
                    </ul>
                </li><!-- / Account -->
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact Us</a>
                </li>
            </ul>
        </div>
        <!-- Navbar-collapse -->
        <ul class="top-menu list-inline mb-0 d-none d-lg-block" id="top-menu">
            <li class="list-inline-item">
                <a href="#" class="search_toggle" id="search-icon"><i class="tf-ion-android-search"></i></a>
            </li>
            <li class="dropdown cart-nav dropdown-slide list-inline-item">
                <div class="nav-cart-box dropdown" id="cart_items">
                    <a href="" class="dropdown-toggle cart-icon" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="tf-ion-android-cart"></i>

                        <!-- <i class="fa fa-shopping-cart text-dark"></i> -->
                        {{-- <img data-toggle="tooltip" data-placement="top" title="Cart" src="{{asset('frontend/images/b15beedcaf38913a9969b50753dd2aa1.svg')}}" alt="cart-logo" class="img-fluid img_sag"> --}}
                        {{-- <span class="nav-box-text d-none d-xl-inline-block">{{__('Cart')}}</span> --}}
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
                </div>
            </li>
            <li class="list-inline-item"><a href="#"><i class="tf-ion-ios-person mr-3"></i></a></li>
        </ul>
    </div>
</nav>
<!--search overlay start-->
<div class="search-wrap">
    <div class="overlay">
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-9">
                        <input class="search_input form-control" type="text" aria-label="Search" id="search" name="q" placeholder="Search..." autocomplete="off" />
                        <button type="submit" class="search_icon d-none"></button>
                    </div>
                    <div class="col-md-2 col-3 text-right">
                        <div class="search_toggle toggle-wrap d-inline-block">
                            <img class="search-close" src="{{asset('frontend/assets/images/close.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-light">
                        <div class="typed-search-box d-none">
                            <div class="search-preloader">
                                <div class="loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="search-nothing d-none">
                            </div>
                            <div id="search-content">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--search overlay end-->