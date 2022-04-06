@extends('frontend.layouts.app')

@section('content')
<section class="page-header">
    <div class="overly"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content text-center">
                    <h1 class="mb-3">Cart</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent justify-content-center">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('cart')}}">Cart</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="order_list_top" class="py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-2 col-4  text-center ">
          {{-- <a href="cart.html"> --}}
            <div class="img_order_list ">
              <div class="img_block_icon">
                <img src="{{asset('frontend/assets/images/cart/cart.svg')}}" class="img-fluid" alt="">
              </div>
              <div class="content_img ">
                <h6 class=""> 1.My Cart</h6>
              </div>
            </div>
          {{-- </a> --}}
        </div>
        <div class="col-md-2 col-4  text-center">
          {{-- <a href="shipping.html"> --}}
            <div class="img_order_list">
              <div class="img_block_icon">
                <img src="{{asset('frontend/assets/images/cart/map.svg')}}" class="img-fluid" alt="">
              </div>
              <div class="content_img">
                <h6 class=""> 2.Shipping Info</h6>
              </div>
            </div>
          {{-- </a> --}}
        </div>
        <div class="col-md-2 col-4  text-center">
          {{-- <a href="delivery.html"> --}}
            <div class="img_order_list">
              <div class="img_block_icon">
                <img src="{{asset('frontend/assets/images/cart/delivery_new.svg')}}" class="img-fluid" alt="">
              </div>
              <div class="content_img">
                <h6 class=""> 3. Delivery Info</h6>
              </div>
            </div>
          {{-- </a> --}}
        </div>
        <div class="col-md-2 col-4  text-center">
          {{-- <a href="payment.html"> --}}
            <div class="img_order_list">
              <div class="img_block_icon">
                <img src="{{asset('frontend/assets/images/cart/payment.svg')}}" class="img-fluid" alt="">
              </div>
              <div class="content_img">
                <h6 class="active-item"> 4. Payment</h6>
              </div>
            </div>
          {{-- </a> --}}
        </div>
        <div class="col-md-2 col-4  text-center">
          {{-- <a href="order-success.html"> --}}
            <div class="img_order_list">
              <div class="img_block_icon">
                <img src="{{asset('frontend/assets/images/cart/confirmation.svg')}}" class="img-fluid" alt="">
              </div>
              <div class="content_img">
                <h6 class=""> 5.Confirmation</h6>
              </div>
            </div>
          {{-- </a> --}}
        </div>
      </div>
    </div>
</section>
    <div id="page-content">
        {{-- <section class="slice-xs sct-color-2 border-bottom">
            <div class="container container-sm">
                <div class="row cols-delimited justify-content-center">
                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-shopping-cart"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. {{__('My Cart')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon mb-0 c-gray-light">
                                <i class="la la-map-o"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">2. {{__('Shipping info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon mb-0 c-gray-light">
                                <i class="la la-truck"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. {{__('Delivery info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center active">
                            <div class="block-icon mb-0">
                                <i class="la la-credit-card"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">4. {{__('Payment')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-check-circle"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">5. {{__('Confirmation')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <section class="py-3 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form action="{{ route('payment.checkout') }}" class="form-default" data-toggle="validator" role="form" method="POST" id="checkout-form">
                            @csrf
                            <div class="card">
                                <div class="card-title px-4 py-3">
                                    <h3 class="heading heading-5 strong-500">
                                        {{__('Select a payment option')}}
                                    </h3>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            <div class="row">
                                                
                                                @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                                    @php
                                                        $digital = 0;
                                                        foreach(Session::get('cart') as $cartItem){
                                                            if($cartItem['digital'] == 1){
                                                                $digital = 1;
                                                            }
                                                        }
                                                    @endphp
                                                    @if($digital != 1)
                                                        <div class="col-6">
                                                            <label class="payment_option mb-4" data-toggle="tooltip" data-title="Cash on Delivery">
                                                                <input type="radio" id="" name="payment_option" value="cash_on_delivery" checked>
                                                                <span>
                                                                    <img loading="lazy"  src="{{ asset('frontend/images/icons/cards/cod.png')}}" class="img-fluid">
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endif
                                                @if (Auth::check())
                                                    @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                                        @foreach(\App\ManualPaymentMethod::all() as $method)
                                                          <div class="col-6">
                                                              <label class="payment_option mb-4" data-toggle="tooltip" data-title="{{ $method->heading }}">
                                                                  <input type="radio" id="" name="payment_option" value="{{ $method->heading }}">
                                                                  <span>
                                                                      <img loading="lazy"  src="{{ asset($method->photo)}}" class="img-fluid">
                                                                  </span>
                                                              </label>
                                                          </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                                @if((\App\BusinessSetting::where('type', 'esewa_payment')->count() > 0) && (\App\BusinessSetting::where('type', 'esewa_payment')->first()->value == 1))
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="esewa">
                                                            {{-- <button id="payment-button">Pay with esewa</button> --}}
                                                            <input type="radio" id="" name="payment_option" value="esewa">
                                                            <span>
                                                                <img loading="lazy" src="{{ asset('frontend/images/icons/cards/esewa.jpg')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @if (Auth::check() && \App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                                        <div class="or or--1 mt-2">
                                            <span>or</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-6 col-lg-8 col-md-10 mx-auto">
                                                <div class="text-center bg-gray py-4">
                                                    <i class="fa"></i>
                                                    <div class="h5 mb-4">Your wallet balance : <strong>{{ single_price(Auth::user()->balance) }}</strong></div>
                                                    @if(Auth::user()->balance < $total)
                                                        <button type="button" class="btn btn-base-2" disabled>Insufficient balance</button>
                                                    @else
                                                        <button  type="button" onclick="use_wallet()" class="btn btn-base-1">Pay with wallet</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif --}}
                                </div>
                            </div>

                            <div class="row align-items-center pt-4">
                                <div class="col-6">
                                    <a href="{{ route('home') }}" class="la la-mail-reply">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>

                                <div class="col-6 text-right">
                                    <button type="button" onclick="submitOrder(this)" class="btn btn-main btn-base-1">{{__('Complete Order')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 ml-lg-auto">
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            $('#checkout-form').submit();
        }
        function submitOrder(el){
            $(el).prop('disabled', true);
            $('#checkout-form').submit();
        }
    </script>
    {{-- <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_eb32162715ff4ac0b16fb0e82fc4dbed",
            "productIdentity": "1234567890",
            "productName": "Pearl Green Tea",
            "productUrl": "http://localhost:8000/product/Pearl-Green-Tea1-ACSSP",
            "paymentPreference": [
                "KHALTI"
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        // var btn = document.getElementById("payment-button");
        // btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 1000});
        // }
    </script> --}}
@endsection
