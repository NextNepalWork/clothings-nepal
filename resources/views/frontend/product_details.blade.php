@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
@endsection

@section('content')

{{-- {{dd(Hash::make(8559))}} --}}
<section class="page-header">
    <div class="overly"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content text-center">
                    <h1 class="mb-3">Product Detail</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent justify-content-center">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('home')}}">{{$detailedProduct->name}}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@php
    $qty = 0;
    if($detailedProduct->variant_product){
        foreach ($detailedProduct->stocks as $key => $stock) {

            $qty += $stock->qty;
        }
    }
    else{
        $qty = $detailedProduct->current_stock ;
    }
@endphp
<section class="single-product">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="single-product-slider">
                    @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
                    <div class="carousel slide" data-ride="carousel" id="single-product-slider">
                        <div class="carousel-inner">
                            @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    @if (file_exists($photo))
                                        <img src="{{asset($photo)}}" alt="{{$detailedProduct->name}}" class="img-fluid">
                                    @else
                                        <img src="{{asset('frontend/images/placeholder.jpg')}}" alt="{{$detailedProduct->name}}" class="img-fluid">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <ol class="carousel-indicators">
                            @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                <li data-target="#single-product-slider" data-slide-to="0" class="{{ $loop->first ? 'active' : '' }}">
                                    @if (file_exists($photo))
                                        <img src="{{asset($photo)}}" alt="{{$detailedProduct->name}}" class="img-fluid">
                                    @else
                                        <img src="{{asset('frontend/images/placeholder.jpg')}}" alt="{{$detailedProduct->name}}" class="img-fluid">
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-details mt-5 mt-lg-0">
                    <h2>{{$detailedProduct->name}}</h2>
                    <div class="sku_wrapper mb-4">
                        SKU: <span class="text-muted">AB1563456789 </span>
                    </div>
                    <hr>
                    @if(home_price($detailedProduct->id) != home_discounted_price($detailedProduct->id))
                        <h3 class="product-price">
                            {{ home_discounted_price($detailedProduct->id) }}
                            <span>/{{ $detailedProduct->unit }}</span> 
                            <del>
                                {{ home_price($detailedProduct->id) }}
                            <span>/{{ $detailedProduct->unit }}</span>
                            </del>
                        </h3>
                    @else
                        <h3 class="product-price">
                            {{ home_discounted_price($detailedProduct->id) }}
                            <span>/{{ $detailedProduct->unit }}</span> 
                        </h3>
                    @endif
                    <p class="product-description my-4 ">
                        {!! str_limit($detailedProduct->description, $limit = 400 ) !!}
                    </p>
                    <form id="option-choice-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                        @if ($detailedProduct->choice_options != null)
                            @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

                                <div class="product-size d-flex align-items-center mt-4">
                                    <span class="font-weight-bold text-capitalize product-meta-title">{{ \App\Attribute::find($choice->attribute_id)->name }}:</span>
                                    
                                        <ul class="list-inline mb-0">
                                            @foreach ($choice->values as $key => $value)
                                                <li class="list-inline-item">
                                                    <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 0) checked @endif>
                                                    <label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                </div>

                            @endforeach
                        @endif

                        @if (count(json_decode($detailedProduct->colors)) > 0)
                            
                            <div class="color-swatches mt-4 d-flex align-items-center">
                                <span class="font-weight-bold text-capitalize product-meta-title">color:</span>
                                <ul class="list-inline mb-0">
                                    @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                            <li class="list-inline-item">
                                                <input type="radio" id="{{ $detailedProduct->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                                <a style="background: {{ $color }};" for="{{ $detailedProduct->id }}-color-{{ $key }}" data-toggle="tooltip"></a>
                                            </li>
                                        @endforeach
                                </ul>
                            </div>
                            <hr>
                        @endif

                        <!-- Quantity + Add to cart -->
                        <div class="quantity d-flex align-items-center">
                            {{-- <div class="col-2">
                                <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                            </div> --}}
                            {{-- <div class="col-10"> --}}
                                {{-- <div class="product-quantity d-flex align-items-center"> --}}
                                    <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled">
                                                <i class="la la-minus"></i>
                                            </button>
                                        </span>
                                        <input type="text" name="quantity" class="form-control input-number text-center" placeholder="1" value="1" min="1" max="10">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button" data-type="plus" data-field="quantity">
                                                <i class="la la-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                    {{-- {{ $qty }} --}}
                                    {{-- <div class="avialable-amount">(<span id="available-quantity">{{ $qty }}</span> {{__('available')}})</div> --}}
                                    @if ($qty > 0)

                                        <a type="button" class="btn btn-main btn-small" onclick="addToCart()">
                                            {{-- <i class="la la-shopping-cart"></i> --}}
                                            {{-- <span class="d-md-inline-block">  --}}
                                                {{__('Add to cart')}}
                                            {{-- </span> --}}
                                        </a>
                                    @else
                                        <a type="button" class="btn btn-main btn-small" disabled>
                                            {{-- <i class="la la-cart-arrow-down"></i>  --}}
                                            {{__('Out of Stock')}}
                                        </a>
                                    @endif

                                {{-- </div> --}}
                            {{-- </div> --}}
                        </div>

                        <hr>

                        <div class="row no-gutters py-2 d-none" id="chosen_price_div">
                            <div class="col-2 m-auto">
                                <div class="product-description-label">{{__('Total Price')}}:</div>
                            </div>
                            <div class="col-10">
                                <div class="product-price">
                                    <strong id="chosen_price">

                                    </strong>
                                </div>
                            </div>
                        </div>

                    </form>
                    {{-- <div class="products-meta mt-4">
                        <div class="product-category d-lg-flex d-block align-items-center">
                            <span class="font-weight-bold text-capitalize product-meta-title">Categories :</span>
                            <a href="#">Products , </a>
                            <a href="#">Soap</a>
                        </div>
                        <div class="product-share mt-5">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#"><i class="tf-ion-social-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="tf-ion-social-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="tf-ion-social-linkedin"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="tf-ion-social-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <nav class="product-info-tabs wc-tabs mt-5 mb-5">
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                            role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Additional Information</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                            role="tab" aria-controls="nav-contact" aria-selected="false">Reviews(2)</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.
                            Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris
                            placerat eleifend leo.</p>
                        <h4>Product Features</h4>
                        <ul class="">
                            <li>Mapped with 3M™ Thinsulate™ Insulation [40G Body / Sleeves / Hood]</li>
                            <li>Embossed Taffeta Lining</li>
                            <li>DRYRIDE Durashell™ 2-Layer Oxford Fabric [10,000MM, 5,000G]</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <ul class="list-unstyled info-desc">
                            <li class="d-flex">
                                <strong>Weight </strong>
                                <span>400 g</span>
                            </li>
                            <li class="d-flex">
                                <strong>Dimensions </strong>
                                <span>10 x 10 x 15 cm</span>
                            </li>
                            <li class="d-flex">
                                <strong>Materials</strong>
                                <span>60% cotton, 40% polyester</span>
                            </li>
                            <li class="d-flex">
                                <strong>Color </strong>
                                <span>Blue, Gray, Green, Red, Yellow</span>
                            </li>
                            <li class="d-flex">
                                <strong>Size</strong>
                                <span>L, M, S, XL, XXL</span>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="media review-block mb-4">
                                    <img src="images/shop/avater-1.jpg" alt="reviewimg" class="img-fluid mr-4">
                                    <div class="media-body">
                                        <div class="product-review">
                                            <span><i class="tf-ion-android-star"></i></span>
                                            <span><i class="tf-ion-android-star"></i></span>
                                            <span><i class="tf-ion-android-star"></i></span>
                                            <span><i class="tf-ion-android-star"></i></span>
                                            <span><i class="tf-ion-android-star"></i></span>
                                        </div>
                                        <h6>NasaTheme <span class="text-sm text-muted font-weight-normal ml-3">-June
                                                23, 2019</span></h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum suscipit
                                            consequuntur in, perspiciatis laudantium ipsa fugit. Iure esse saepe
                                            error dolore quod.</p>
                                    </div>
                                </div>
                                <div class="media review-block">
                                    <img src="images/shop/avater-2.jpg" alt="reviewimg" class="img-fluid mr-4">
                                    <div class="media-body">
                                        <div class="product-review">
                                            <span><i class="tf-ion-android-star"></i></span>
                                            <span><i class="tf-ion-android-star"></i></span>
                                            <span><i class="tf-ion-android-star"></i></span>
                                            <span><i class="tf-ion-android-star"></i></span>
                                            <span><i class="tf-ion-android-star-outline"></i></span>
                                        </div>
                                        <h6>NasaTheme <span class="text-sm text-muted font-weight-normal ml-3">-June
                                                23, 2019</span></h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum suscipit
                                            consequuntur in, perspiciatis laudantium ipsa fugit. Iure esse saepe
                                            error dolore quod.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="review-comment mt-5 mt-lg-0">
                                    <h4 class="mb-3">Add a Review</h4>
                                    <form action="#">
                                        <div class="starrr"></div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Your Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Your Email">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="comment" id="comment" class="form-control" cols="30"
                                                rows="4" placeholder="Your Review"></textarea>
                                        </div>
                                        <a href="#" class="btn btn-main btn-small">Submit Review</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="products related-products section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="title text-center">
                    <h2>You may like this</h2>
                    <p>The best Online sales to shop these weekend</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="product">
                    <div class="product-wrap">
                        <a href="product-single.html"><img class="img-fluid w-100 mb-3 img-first"
                                src="images/shop/products/322.jpg" alt="product-img"></a>
                    </div>
                    <span class="onsale">Sale</span>
                    <div class="product-hover-overlay">
                        <a href="#"><i class="tf-ion-android-cart"></i></a>
                        <a href="#"><i class="tf-ion-ios-heart"></i></a>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title h5 mb-0"><a href="product-single.html">Floral Kirby</a></h2>
                        <span class="price">
                            $329.10
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="product">
                    <div class="product-wrap">
                        <a href="product-single.html"><img class="img-fluid w-100 mb-3 img-first"
                                src="images/shop/products/111.jpg" alt="product-img"></a>
                    </div>
                    <div class="product-hover-overlay">
                        <a href="#"><i class="tf-ion-android-cart"></i></a>
                        <a href="#"><i class="tf-ion-ios-heart"></i></a>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title h5 mb-0"><a href="product-single.html">Open knit switer</a></h2>
                        <span class="price">
                            $29.10
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="product">
                    <div class="product-wrap">
                        <a href="product-single.html"><img class="img-fluid w-100 mb-3 img-first"
                                src="images/shop/products/222.jpg" alt="product-img"></a>
                    </div>
                    <span class="onsale">Sale</span>
                    <div class="product-hover-overlay">
                        <a href="#"><i class="tf-ion-android-cart"></i></a>
                        <a href="#"><i class="tf-ion-ios-heart"></i></a>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title h5 mb-0"><a href="product-single.html">Official trendy</a></h2>
                        <span class="price">
                            $350.00 – $355.00
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="product">
                    <div class="product-wrap">
                        <a href="product-single.html"><img class="img-fluid w-100 mb-3 img-first"
                                src="images/shop/products/322.jpg" alt="product-img"></a>
                    </div>
                    <div class="product-hover-overlay">
                        <a href="#"><i class="tf-ion-android-cart"></i></a>
                        <a href="#"><i class="tf-ion-ios-heart"></i></a>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title h5 mb-0"><a href="product-single.html">Frock short</a></h2>
                        <span class="price">
                            $249
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Any query about this product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="Your Question">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-4">
                                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                                <span class="input-group-addon">
                                                    <i class="text-md la la-user"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                                <span class="input-group-addon">
                                                    <i class="text-md la la-lock"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <a href="#" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-styled btn-base-1 px-4">{{__('Sign in')}}</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-4">
                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 my-4">
                                            <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                        </a>
                                    @endif
                                    @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 my-4">
                                            <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                        </a>
                                    @endif
                                    @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 my-4">
                                        <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
    		$('#share').jsSocials({
    			showLabel: false,
                showCount: false,
                shares: ["email", "twitter", "facebook", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
    		});
            getVariantPrice();
    	});

        function CopyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("Copy");

            } else if (window.getSelection) {
                var range = document.createRange();
                document.getElementById(containerid).style.display = "block";
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("Copy");
                document.getElementById(containerid).style.display = "none";

            }
            showFrontendAlert('success', 'Copied');
        }

        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }

    </script>
@endsection
