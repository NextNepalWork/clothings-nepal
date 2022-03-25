<div class="modal-body p-4 added-to-cart">
    <div class="text-center text-success">
        <i class="fa fa-check"></i>
        <h3>{{__('Item added to your cart!')}}</h3>
    </div>
    <div class="product-box">
        <div class="block">
            <div class="block-image">
                @if (!empty(json_decode($product->photos)[0]))
                    @if (file_exists(json_decode($product->photos)[0]))
                        <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(json_decode($product->photos)[0]) }}" class="lazyload" alt="{{$product->name}}">
                    @else
                        <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="lazyload" alt="{{$product->name}}">
                    @endif
                @else
                    <img src="{{ asset('frontend/images/placeholder.jpg') }}" class="lazyload" alt="{{$product->name}}">
                @endif
            </div>
            <div class="block-body">
                <h6 class="strong-600">
                    {{ __($product->name) }}
                </h6>
                <div class="row align-items-center no-gutters mt-2 mb-2">
                    <div class="col-sm-2">
                        <div>{{__('Price')}}:</div>
                    </div>
                    <div class="col-sm-10">
                        <div class="heading-6 text-danger">
                            <strong>
                                {{ single_price(($data['price']+$data['tax'])*$data['quantity']) }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-main mb-3 py-2 px-3" data-dismiss="modal">{{__('Back to shopping')}}</button>
        <a href="{{ route('cart') }}" class="btn btn-main mb-3 py-2 px-3">{{__('Proceed to Checkout')}}</a>
    </div>
</div>
