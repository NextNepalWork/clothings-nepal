<div class="modal-body p-4">
    <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
        <div class="col-lg-6">
            <div class="product-gal sticky-top d-flex flex-row-reverse">
                @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                    <div class="product-gal-img">
                        @if(!empty(json_decode($product->photos)[0]))
                            @if (file_exists(json_decode($product->photos)[0]))  
                                <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(json_decode($product->photos)[0]) }}" xoriginal="{{ asset(json_decode($product->photos)[0]) }}"/>
                            @else
                                <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}"/>
                                
                            @endif
                        @else
                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}"/>

                        @endif
                    </div>
                    <div class="product-gal-thumb">
                        <div class="xzoom-thumbs">
                            @foreach (json_decode($product->photos) as $key => $photo)
                                <a href="{{ asset($photo) }}">
                                    @if (!empty($photo))
                                        @if (file_exists($photo))
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" width="80" data-src="{{ asset($photo) }}" @if($key == 0) xpreview="{{ asset($photo) }}" @endif> 
                                        @else
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" width="80" @if($key == 0) xpreview="{{ asset($photo) }}" @endif>
                                        @endif
                                    @else
                                        <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" width="80" @if($key == 0) xpreview="{{ asset($photo) }}" @endif>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Product description -->
            <div class="product-description-wrapper">
                <!-- Product title -->
                <h2 class="product-title">
                    {{ __($product->name) }}
                </h2>

                @if(home_price($product->id) != home_discounted_price($product->id))

                    <div class="row no-gutters mt-4">
                        <div class="col-2">
                            <div class="product-description-label">{{__('Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price-old">
                                <del>
                                    {{ home_price($product->id) }}
                                    <span>/{{ $product->unit }}</span>
                                </del>
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters mt-3">
                        <div class="col-2">
                            <div class="product-description-label mt-1">{{__('Discount Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong>
                                    {{ home_discounted_price($product->id) }}
                                </strong>
                                <span class="piece">/{{ $product->unit }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row no-gutters mt-3">
                        <div class="col-2">
                            <div class="product-description-label">{{__('Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong>
                                    {{ home_discounted_price($product->id) }}
                                </strong>
                                <span class="piece">/{{ $product->unit }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated && $product->earn_point > 0)
                    <div class="row no-gutters mt-4">
                        <div class="col-2">
                            <div class="product-description-label">{{ __('Club Point') }}:</div>
                        </div>
                        <div class="col-10">
                            <div class="d-inline-block club-point bg-soft-base-1 border-light-base-1 border">
                                <span class="strong-700">{{ $product->earn_point }}</span>
                            </div>
                        </div>
                    </div>
                @endif --}}

                <hr>

                @php
                    $qty = 0;
                    if($product->variant_product){
                        foreach ($product->stocks as $key => $stock) {
                            $qty += $stock->qty;
                        }
                    }
                    else{
                        $qty = $product->current_stock;
                    }
                @endphp

                <form id="option-choice-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <!-- Quantity + Add to cart -->
                    @if($product->digital !=1)
                        @if ($product->choice_options != null)
                            @foreach (json_decode($product->choice_options) as $key => $choice)

                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div
                                            class="product-description-label mt-2 ">{{ \App\Attribute::find($choice->attribute_id)->name }}
                                            :
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                            @foreach ($choice->values as $key => $value)
                                                <li>
                                                    <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}"
                                                           name="attribute_id_{{ $choice->attribute_id }}"
                                                           value="{{ $value }}" @if($key == 0) checked @endif>
                                                    <label
                                                        for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            @endforeach
                        @endif

                        @if (count(json_decode($product->colors)) > 0)
                            <div class="row no-gutters">
                                <div class="col-2">
                                    <div class="product-description-label mt-2">{{__('Color')}}:</div>
                                </div>
                                <div class="col-10">
                                    <ul class="list-inline checkbox-color mb-1">
                                        @foreach (json_decode($product->colors) as $key => $color)
                                            <li>
                                                <input type="radio" id="{{ $product->id }}-color-{{ $key }}"
                                                       name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                                <label style="background: {{ $color }};"
                                                       for="{{ $product->id }}-color-{{ $key }}"
                                                       data-toggle="tooltip"></label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <hr>
                        @endif

                        <div class="row no-gutters">
                            <div class="col-2">
                                <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                            </div>
                            <div class="col-10">
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button" data-type="minus"
                                                    data-field="quantity" disabled="disabled" style="    border: none;
                                                    padding: 15px;">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </span>
                                        <input type="text" name="quantity" class="form-control input-number text-center"
                                               placeholder="1" value="1" min="1" max="10">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button" data-type="plus"
                                                    data-field="quantity" style="border: none;
                                                    padding: 15px;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="avialable-amount">(<span
                                            id="available-quantity">{{ $qty }}</span> {{__('available')}})
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                    @endif

                    <div class="row no-gutters pb-3" id="chosen_price_div">
                        <div class="col-2">
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

                <div class="d-table width-100 mt-3">
                    <div class="d-flex justify-content-between">
                        <!-- Add to cart button -->
                        @if ($product->digital == 1)
                            <button type="button"
                                    class="btn btn-main mb-3 py-2 px-3 add-to-cart"
                                    onclick="addToCart()">
                                <i class="la la-shopping-cart"></i>
                                <span class="d-none d-md-inline-block"> {{__('Add to cart')}}</span>
                            </button>
                        @else
                            @if($qty > 0)
                                <button type="button"
                                        class="btn btn-main mb-3 py-2 px-3 add-to-cart"
                                        onclick="addToCart()">
                                    <i class="la la-shopping-cart"></i>
                                    <span class="d-none d-md-inline-block"> {{__('Add to cart')}}</span>
                                </button>
                                <button type="button" class="btn btn-main mb-3 py-2 px-3" onclick="buyNow()">
                                    <i class="la la-shopping-cart"></i> Buy Now
                                </button>
                            @else
                                <button type="button" class="btn btn-main mb-3 py-2 px-3" disabled>
                                    <i class="la la-cart-arrow-down"></i> {{__('Out of Stock')}}
                                </button>
                            @endif
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    cartQuantityInitialize();
    $('#option-choice-form input').on('change', function () {
        getVariantPrice();
    });
</script>
