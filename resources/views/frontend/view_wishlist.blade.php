@extends('frontend.layouts.app')

@section('content')
<section class="page-header">
    <div class="overly"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="content text-center">
            <h1 class="mb-3">Wishlist</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent justify-content-center">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('wishlists.index')}}">Wishlist</a> </li>
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
                
                <div class="col-lg-9 col-md-12 col-12 mt-lg-0 mt-3">
                    <div class="dashboard-content d-flex align-items-center h-100">
                      <div class="shopping-cart">
                        <div class="shopping-cart-table">
                          <div class="table-responsive-lg">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="cart-description item">Image</th>
                                  <th class="cart-product-name item">Product Name</th>
                                  <th class="cart-total last-item">Total</th>
                                  <th class="cart-romove item">Remove</th>
                                </tr>
                              </thead>
                              <!-- /thead -->
                              <tbody>
                                @foreach ($wishlists as $key => $wishlist)
                                @if ($wishlist->product != null)
                                <tr id="wishlist_{{ $wishlist->id }}">
                                  <td class="cart-image">
                                    <a class="entry-thumbnail" href="{{ route('product', $wishlist->product->slug) }}">
                                        @if (!empty($wishlist->product->thumbnail_img))
                                            @if(file_exists($wishlist->product->thumbnail_img))
                                                <img src="{{asset($wishlist->product->thumbnail_img)}}" class="img-fluid">
                                            @else
                                                <img src="{{asset('frontend/images/placeholder.jpg')}}" class="img-fluid">
                                            @endif
                                        @else
                                            <img src="{{asset('frontend/images/placeholder.jpg')}}" class="img-fluid"> 
                                        @endif
                                    </a>
                                  </td>
                                  <td class="cart-product-name-info">
                                    <h4 class="cart-product-description"><a href="{{ route('product', $wishlist->product->slug) }}">{{$wishlist->product->name}}</a></h4>
                                    <div class="row">
                                      <div class="col-4">
                                        <div class="rating rateit-small"></div>
                                      </div>
                                    </div>
                                    <!-- /.row -->
                                  </td>
                                  <td class="cart-product-grand-total">
                                    <span class="cart-grand-total-price">
                                        @if(home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                                            <del class="old-product-price strong-400">{{ home_base_price($wishlist->product->id) }}</del>
                                        @endif
                                        <br>
                                        <span class="product-price strong-600">{{ home_discounted_base_price($wishlist->product->id) }}</span>
                                    </span>
                                  </td>
                                  <td class="romove-item">
                                    <a href="#" class="icon" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})"><i
                                        class="fa fa-trash-o"></i></a>
                                  </td>
                                  <td>
                                    <button type="button" class="btn btn-main" onclick="showAddToCartModal({{ $wishlist->product->id }})">
                                        {{__('Add to cart')}}
                                    </button>
                                  </td>
                                </tr>
                                @endif
                                @endforeach
                              </tbody>
                              <!-- /tbody -->
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                showFrontendAlert('success', 'Item has been removed from wishlist');
            })
        }
    </script>
@endsection
