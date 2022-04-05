{{-- <section class="mb-4">
    <div class="container">
        <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
            <div class="section-title-1 clearfix">
                <h3 class="heading-5 strong-700 mb-0 float-left">
                    <span class="mr-4">{{__('Featured Products')}}</span>
                </h3>
            </div>
            <div class="caorusel-box arrow-round gutters-5">
                <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                    @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)
                    <div class="caorusel-card">
                        <div class="product-box-2 bg-white alt-box my-2">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100 text-center">
                                    @if (empty($product->thumbnail_img))
                                        <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{ __($product->name . '-' . $product->unit_price ) }}">
                                    @else
                                        <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name . '-' . $product->unit_price ) }}">
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
                                <div class="product-btns clearfix">
                                    <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})" tabindex="0">
                                        <i class="la la-heart-o"></i>
                                    </button>
                                    <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})" tabindex="0">
                                        <i class="la la-refresh"></i>
                                    </button>
                                    <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->id }})" tabindex="0">
                                        <i class="la la-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="p-md-3 p-2">
                                <div class="price-box">
                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                    @endif
                                    <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                </div>
                                <div class="star-rating star-rating-sm mt-1">
                                    {{ renderStarRating($product->rating) }}
                                </div>
                                <h2 class="product-title p-0">
                                    <a href="{{ route('product', $product->slug) }}" class="text-truncate">{{ __($product->name) }}</a>
                                </h2>

                                @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                    <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                        {{ __('Club Point') }}:
                                        <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}

<div class="widget-featured-entries mt-5 mt-lg-0">
    <h4 class="mb-4 pb-3">Top Products</h4>
    @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(5)->get() as $key => $product)

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