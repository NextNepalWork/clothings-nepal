{{-- @if (\App\BusinessSetting::where('type', 'best_selling')->first()->value == 1)
    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{__('Best Selling')}}</span>
                    </h3>
                    <ul class="inline-links float-right">
                        <li><a  class="active">{{__('Top 20')}}</a></li>
                    </ul>
                </div>
                <div class="caorusel-box arrow-round gutters-5">
                    <div class="slick-carousel" data-slick-items="3" data-slick-lg-items="2"  data-slick-md-items="2" data-slick-sm-items="1" data-slick-xs-items="1" data-slick-rows="2">
                        @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(20)->get() as $key => $product)
                            <div class="caorusel-card my-1">
                                <div class="row no-gutters product-box-2 align-items-center">
                                    <div class="col-4">
                                        <div class="position-relative overflow-hidden h-100">
                                            <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100">
                                            @if (empty($product->photos))
                                                <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{ __($product->name) }}">        
                                            @else        
                                                <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(json_decode($product->photos)[0]) }}" alt="{{ __($product->name) }}">
                                            @endif
                                                    
                                            </a>
                                            @php
                                        $qty = 0;
                                        if($product->variant_product){
                                            foreach ($product->stocks as $key => $stock) {
                                                $qty += $stock->qty;
                                            }
                                        }
                                        else{
                                            $qty = $product->current_stock ;
                                        }
                                        @endphp
                                    @if($qty == 0)
                                    <span class="stock">
                                        Out of Stock
                                    </span>
                                    @endif

                                            <div class="product-btns">
                                                <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})">
                                                    <i class="la la-heart-o"></i>
                                                </button>
                                                <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})">
                                                    <i class="la la-refresh"></i>
                                                </button>
                                                <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->id }})">
                                                    <i class="la la-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8 border-left">
                                        <div class="p-3">
                                            <h2 class="product-title mb-0 p-0 text-truncate-2">
                                                <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                            </h2>
                                            <div class="star-rating star-rating-sm mb-2">
                                                {{ renderStarRating($product->rating) }}
                                            </div>
                                            <div class="clearfix">
                                                <div class="price-box float-left">
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    <span class="product-price strong-600">
                                                        {{ home_discounted_base_price($product->id) }}
                                                    </span>
                                                </div>
                                                <div class="float-right">
                                                    <button class="add-to-cart btn" title="Add to Cart" onclick="showAddToCartModal({{ $product->id }})">
                                                        <i class="la la-shopping-cart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif --}}

{{-- asdfasdfasd --}}
<div class="widget-featured-entries mt-5 mt-lg-0">
    <h4 class="mb-4 pb-3">Best Selling</h4>
    @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(5)->get() as $key => $product)

    <div class="media mb-3">
        <a class="featured-entry-thumb" href="{{ route('product', $product->slug) }}">
            @if (!empty($product->thumbnail_img))
                @if(file_exists($product->thumbnail_img))
                    <img class="img-fluid mr-3" src="{{ asset($product->thumbnail_img) }}" width="64" alt="{{ __($product->name . '-' . $product->unit_price ) }}">
                @else
                    <img src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{ __($product->name) }}" width="64" class="img-fluid mr-3">
                @endif
            @else
                <img src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{ __($product->name) }}" width="64" class="img-fluid mr-3">

            @endif
        </a>
        <div class="media-body">
            <h6 class="featured-entry-title mb-0"><a href="{{ route('product', $product->slug) }}">{{$product->name}}</a></h6>
            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
            <small>
                <strike>
                    {{ home_base_price($product->id) }}
                </strike>
            </small>
            @endif
            <p class="featured-entry-meta">{{ home_discounted_base_price($product->id) }}</p>
        </div>
    </div>
    @endforeach
</div>

