@extends('frontend.layouts.app')

@section('content')
<!--Slider start-->
<div class="main-slider slider">
    @foreach (\App\Slider::where('published', 1)->get() as $key => $slider)
        <div class="slider-item " style="background-image:url('{{ asset($slider->photo) }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 offset-lg-5 offset-md-3">
                        <div class="slider-caption">
                            <span class="lead">Winter Collection Sale </span>
                            <h1 class="mt-2 mb-5"><span class="text-color">70% off </span>to everything</h1>
                            <a href="shop.html" class="btn btn-main">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!--Slider end-->

<!-- category section start -->
<section id="category_section">
    <div class="container mx-auto">
        <div class="slick_category text-center">
            @foreach (\App\Category::where('featured', 1)->get() as $key => $category)
            <div class="category_men_block">
                <a href="{{ route('products.category', $category->slug) }}">
                    <div class="grid-item">
                        @if(!empty($category->banner))
                            @if (file_exists($category->banner))
                                <img src="{{ asset($category->banner) }}"  data-src="{{ asset($category->banner) }}" alt="{{ __($category->name) }}" class="img-fluid img-fit lazyloaded">
                            @else
                                <img src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{ __($category->name) }}" class="img-fluid img-fit lazyloaded">
                            @endif
                        @else
                        <img src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{ __($category->name) }}" class="img-fluid img-fit lazyloaded">
                        @endif
                    </div>
                    <div class="text_cate">
                        <h3>{{ __($category->name) }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- category section end -->

<!-- new arrival start -->
<section class="section products-main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="title text-center">
                    <h2>New arrivals</h2>
                    <p>The best Online sales to shop these weekend</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach (\App\Product::where('published', 1)->latest()->limit(8)->get() as $key => $product)
            <div class="col-lg-3 col-12 col-md-6 col-sm-6 mb-5">
                <div class="product">
                    <div class="product-wrap">
                        @if(!empty($product->thumbnail_img))
                            @if (file_exists($product->thumbnail_img))
                                <a href="{{route('product',$product->slug)}}"><img class="img-fluid w-100 mb-3 img-first" src="{{($product->thumbnail_img)}}" alt="{{$product->name}}"></a>
                            @else
                                <a href="{{route('product',$product->slug)}}"><img class="img-fluid w-100 mb-3 img-first" src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{$product->name}}"></a>
                            @endif
                        @else
                            <a href="{{route('product',$product->slug)}}"><img class="img-fluid w-100 mb-3 img-first" src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{$product->name}}"></a>
                        @endif
                    </div>
                    <span class="onsale">Sale</span>
                    <div class="product-hover-overlay">
                        <a  title="Quick view" onclick="showAddToCartModal({{ $product->id }})" tabindex="0">
                            <i class="tf-ion-android-cart"></i>
                        </a>
                        <a title="Add to Wishlist" onclick="addToWishList({{ $product->id }})" tabindex="0">
                            <i class="tf-ion-ios-heart"></i>
                        </a>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title h5 mb-0"><a href="{{route('product',$product->slug)}}">{{$product->name}}</a></h2>
                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                            <del class="price">{{ home_base_price($product->id) }}</del>
                        @endif
                        <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                        {{-- <span class="price">
                            $329.10
                        </span> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- new arrival end -->


<!-- banner start -->
@php
    $banner=\App\Banner::where('position', 1)->where('published', 1)->get();
@endphp

<section class="ads section" style="background-image: url('{{$banner[0]->photo}}')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 offset-lg-6">
                <div class="content">
                    <span class="h5 deal">Deal of the day 50% Off</span>
                    <h2 class="mt-3 text-white">Trendy Dress</h2>
                    <p class="text-md mt-3 text-white">Hurry up! Limited time offer.Grab ot now!</p>
                    <!-- syo-timer -->
                    <!-- <div id="simple-timer" class="syotimer mb-5"></div> -->
                    <a href="{{$banner[0]->url}}" class="btn btn-main"><i class="ti-bag mr-2"></i>Shop Now </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner end -->

@php
    $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();    
    $time = [];
@endphp

<!-- Product section -->
<section class="section products-list">
    <div class="container">
        <div class="row">
            <!-- Flash sale section -->
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="flash_men my-4 my-md-0">
                    @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                            @php
                                $product = \App\Product::find($flash_deal_product->product_id);
                                $enddate = $flash_deal->end_date;
                                $time = date('m/d/Y', $enddate);
                                // dd($product);
                            @endphp
        
                            @if ($product != null && $product->published != 0)
                                <div class="special_offer_men p-4 text-center">
                                    <div class="special_header d-flex justify-content-between align-items-center">
                                        <div class="special_title">
                                        <h4>Special Offer</h4>
                                        </div>
                                        <div class="savings">
                                            <span class="savings-text">
                                                <span class="font-weight-normal"> Save</span> 
                                                    <span class="woocommerce-Price-amount amount font-weight-bold"><bdi>
                                                        <span class="woocommerce-Price-currencySymbol">
                                                            {{ ($flash_deal_product->discount_type == 'amount')?'Rs.':'%' }}
                                                        </span>
                                                        {{ $flash_deal_product->discount }}
                                                        </bdi>
                                                    </span> 
                                            </span>
                                        </div>
                                    </div>
                                    <div class="special_left">
                                        <a href="{{ route('product', $product->slug) }}">
                                            @if (!empty($product->thumbnail_img))
                                                <img class="img-fit lazyload" src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name . '-' . $product->unit_price ) }}">
                                            @else
                                                <img class="img-fit lazyload" src="{{ asset(json_decode($product->photos)[0]) }}" alt="{{ __($product->name . '-' . $product->unit_price ) }}">
                                            @endif
                                            <h6>{{ __($product->name) }}</h6>
                                        </a>
                                    </div>
                                    <div class="special_price_le py-2">
                                        <h4> 
                                            <span class="red_text">
                                                {{ home_discounted_base_price($product->id) }}
                                            </span> 
                                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                <small>
                                                    <strike>
                                                        {{ home_base_price($product->id) }}
                                                    </strike>
                                                </small> 
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="special_countdown">
                                        <div class="content_left">
                                        <h5 id="headline">Hurry Up! Offer ends in:</h5>
                                        <div id="countdown">
                                            <ul class="d-flex align-items-center justify-content-around m-0 p-0">
                                                <!-- <li class="d-flex flex-column"><span id="days"></span>days</li> -->
                                                <span class="demo"></span>
                                                {{-- <li class="d-flex flex-column"><span id="hours"></span>Hours</li>
                                                <li class="d-flex flex-column"><span id="minutes"></span>Minutes</li>
                                                <li class="d-flex flex-column"><span id="seconds"></span>Seconds</li> --}}
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    @endforeach
                </div>
            </div>
            <!-- Flash sale section -->

            <!-- Featured section -->
            <div class="col-lg-4 col-sm-6 col-md-6" id="section_featured">

            </div>
            <!-- Featured section -->

            <!-- Best selling section -->

            @if (\App\BusinessSetting::where('type', 'best_selling')->first()->value == 1)
            <div class="col-lg-4 col-sm-6 col-md-6" id="section_best_selling">

            </div>
            @endif
            <!-- Best selling section -->


        </div>
    </div>
</section>
<!-- Product section -->


<section class="features border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="feature-block">
                    <i class="tf-ion-android-bicycle"></i>
                    <div class="content">
                        <h5>Free Shipping</h5>
                        <p>On all order over Rs.1000</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="feature-block">
                    <i class="tf-wallet"></i>
                    <div class="content">
                        <h5>30 Days Return</h5>
                        <p>Money back Guarantee</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="feature-block">
                    <i class="tf-key"></i>
                    <div class="content">
                        <h5>Secure Checkout</h5>
                        <p>100% Protected by paypal</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="feature-block">
                    <i class="tf-clock"></i>
                    <div class="content">
                        <h5>24/7 Support</h5>
                        <p>All time customer support </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                // console.log(data);
                $('#section_featured').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                slickInit();
            });
        });
    </script>
@endsection

