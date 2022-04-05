@extends('frontend.layouts.app')

@section('content')

    {{-- <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{ __('Dashboard') }}
                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                        <li class="active"><a
                                                href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center green-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-shopping-cart"></i>
                                        @if (Session::has('cart'))
                                            <span class="d-block title">{{ count(Session::get('cart')) }}
                                                {{ __('Product(s)') }}</span>
                                        @else
                                            <span class="d-block title">0 {{ __('Product') }}</span>
                                        @endif
                                        <span class="d-block sub-title">{{ __('in your cart') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center red-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-heart"></i>
                                        <span class="d-block title">{{ count(Auth::user()->wishlists) }}
                                            {{ __('Product(s)') }}</span>
                                        <span class="d-block sub-title">{{ __('in your wishlist') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center yellow-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-building"></i>
                                        @php
                                            $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                                            $total = 0;
                                            foreach ($orders as $key => $order) {
                                                $total += count($order->orderDetails);
                                            }
                                        @endphp
                                        <span class="d-block title">{{ $total }} {{ __('Product(s)') }}</span>
                                        <span class="d-block sub-title">{{ __('you ordered') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @php
                            $newCustomerCoupon = \App\Coupon::where('new_customer', 1)->get();
                        @endphp
                        @if ($newCustomerCoupon)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-box bg-white mt-4">
                                        <div class="form-box-title px-3 py-2 clearfix ">
                                            {{ __('Coupon for new customer') }}
                                        </div>
                                        <div class="form-box-content p-3">
                                            <table
                                                class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Base</th>
                                                        <th>Coupon Code</th>
                                                        <th>Discount</th>
                                                        <th>Detail(s)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($newCustomerCoupon as $coupon)
                                                        <tr>
                                                            @if (collect(json_decode($coupon->details, true))->pluck('product_id')[0] != null)
                                                                <td>Product Base</td>
                                                                <td class="font-weight-bold">{{ $coupon->code }}</td>
                                                                <td>
                                                                    @if($coupon->discount_type == 'amount')
                                                                        Rs. {{ $coupon->discount }}
                                                                    @else
                                                                        {{ $coupon->discount }}%
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @foreach (collect(json_decode($coupon->details, true))->pluck('product_id') as $id)
                                                                        <li>"{{ \App\Product::where('id', $id)->pluck('name')->first() }}"</li>
                                                                    @endforeach
                                                                </td>
                                                            @else
                                                                @php
                                                                    $minItem = collect(json_decode($coupon->details, true))['min_buy'];
                                                                @endphp
                                                                <td>Cart Base</td>
                                                                <td class="font-weight-bold">{{ $coupon->code }}</td>
                                                                <td>
                                                                    @if($coupon->discount_type == 'amount')
                                                                        Rs. {{ $coupon->discount }}
                                                                    @else
                                                                        {{ $coupon->discount }}%
                                                                    @endif
                                                                </td>
                                                                <td>minimum
                                                                    {{ $minItem > 1 ? $minItem . ' items' : $minItem . ' item' }}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        {{ __('Default Shipping Address') }}
                                        <div class="float-right">
                                            <a href="{{ route('profile') }}"
                                                class="btn btn-link btn-sm">{{ __('Edit') }}</a>
                                        </div>
                                    </div>
                                    <div class="form-box-content p-3">
                                        @if (Auth::user()->addresses != null)
                                            @php
                                                $address = Auth::user()
                                                    ->addresses->where('set_default', 1)
                                                    ->first();
                                            @endphp
                                            @if ($address != null)
                                                <table>
                                                    <tr>
                                                        <td>{{ __('Address') }}:</td>
                                                        <td class="p-2">{{ $address->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Country') }}:</td>
                                                        <td class="p-2">
                                                            {{ $address->country }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('City') }}:</td>
                                                        <td class="p-2">{{ $address->city }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Postal Code') }}:</td>
                                                        <td class="p-2">{{ $address->postal_code }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Phone') }}:</td>
                                                        <td class="p-2">{{ $address->phone }}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (\App\BusinessSetting::where('type', 'classified_product')->first()->value)
                                <div class="col-md-6">
                                    <div class="form-box bg-white mt-4">
                                        <div class="form-box-title px-3 py-2 clearfix ">
                                            {{ __('Purchased Package') }}
                                        </div>
                                        @php
                                            $customer_package = \App\CustomerPackage::find(Auth::user()->customer_package_id);
                                        @endphp
                                        <div class="form-box-content p-3">
                                            @if ($customer_package != null)
                                                <div class="form-box-content p-2 category-widget text-center">
                                                    <center><img alt="Package Logo"
                                                            src="{{ asset($customer_package->logo) }}"
                                                            style="height:100px; width:90px;"></center>
                                                    <br>
                                                    <left> <strong>
                                                            <p>{{ __('Product Upload') }}:
                                                                {{ $customer_package->product_upload }}
                                                                {{ __('Times') }}</p>
                                                        </strong></left>
                                                    <strong>
                                                        <p>{{ __('Product Upload Remaining') }}:
                                                            {{ Auth::user()->remaining_uploads }} {{ __('Times') }}
                                                        </p>
                                                    </strong>
                                                    <strong>
                                                        <p>
                                                        <div class="name mb-0">{{ __('Current Package') }}:
                                                            {{ $customer_package->name }} <span class="ml-2"><i
                                                                    class="fa fa-check-circle"
                                                                    style="color:green"></i></span></div>
                                                        </p>
                                                    </strong>
                                                </div>
                                            @else
                                                <div class="form-box-content p-2 category-widget text-center">
                                                    <center><strong>
                                                            <p>{{ __('Package Not Found') }}</p>
                                                        </strong></center>
                                                </div>
                                            @endif
                                            <div class="text-center">
                                                <a href="{{ route('customer_packages_list_show') }}"
                                                    class="btn btn-styled btn-base-1 btn-outline btn-sm">{{ __('Upgrade Package') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}
    <section class="page-header">
        <div class="overly"></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="content text-center">
                <h1 class="mb-3">Dashboard</h1>
    
    
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb bg-transparent justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
    </section>
    <section class="user-dashboard page-wrapper">
        <div class="container">
            <div class="row">
                @include('frontend.inc.customer_side_nav')
                @php
                    $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                    $total = 0;
                    $success=0;
                    $pending=0;
                    foreach ($orders as $key => $order) {
                        $total += count($order->orderDetails);
                        $success += count($order->orderDetails->where('delivery_status','delivered'));
                        $pending += count($order->orderDetails->where('delivery_status','pending'));
                    }
                @endphp
                <div class="col-lg-9 col-md-12 col-12 mt-lg-0 mt-3">
                    <div class="row box-shadows">
                    <div class="col-lg-3 col-md-6 col-6 mb-lg-0 md-md-2 mb-2">
                        <div class="dashboard-widget text-center green-widget c-pointer">
                        <a href="javascript:;" class="d-block">
                            <i class="fa fa-heart"></i>
                            <span class="d-block  heading-3 strong-400">{{ count(Auth::user()->wishlists) }}</span>
                            <span class="d-block sub-title">Total Wishlists</span>
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-lg-0 md-md-2 mb-2">
                        <div class="dashboard-widget text-center red-widget c-pointer">
                        <a href="javascript:;" class="d-block">
                            <i class="fa fa-heart"></i>
                            <span class="d-block  heading-3 strong-400">{{ $total }}</span>
                            <span class="d-block sub-title">Total orders</span>
                        </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-lg-0 md-md-2 mb-2">
                        <div class="dashboard-widget text-center blue-widget c-pointer">
                        <a href="javascript:;" class="d-block">
                            <i class="fa fa-file"></i>
                            <span class="d-block  heading-3 strong-400">{{$success}}</span>
                            <span class="d-block sub-title">Successful Orders</span>
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-lg-0 md-md-2 mb-2">
                        <div class="dashboard-widget text-center yellow-widget c-pointer">
                        <a href="javascript:;" class="d-block">
                            <i class="fa fa-check-square-o"></i>
                            <span class="d-block  heading-3 strong-400">{{$pending}}</span>
                            <span class="d-block sub-title">Pending Orders</span>
                        </a>
                        </div>
                    </div>
                    </div>
                    <div class="row bg-light">
                    <div class="col-lg-7 col-12">
                        <div class="form-box bg-white my-4">
                        <div class="form-box-title px-3 py-2 text-center">
                            Orders
                        </div>
                        <div class="form-box-content p-3">
                            <table class="table mb-0 table-bordered" style="font-size:14px;">
                            <tbody>
                                <tr>
                                <td>Total orders:</td>
                                <td><strong class="heading-6">{{$total}}</strong></td>
                                </tr>
                                <tr>
                                <td>Pending orders:</td>
                                <td><strong class="heading-6">{{$pending}}</strong></td>
                                </tr>
                                <tr>

                                <td>Successful orders:</td>
                                <td><strong class="heading-6">{{$success}}</strong></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    

@endsection
