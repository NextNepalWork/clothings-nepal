@extends('frontend.layouts.app')

@section('content')
<section class="page-header">
    <div class="overly"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="content text-center">
            <h1 class="mb-3">Profile</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent justify-content-center">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('profile')}}">Manage Profile</a></li>
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
                      <div class="submit-section">
                        <h4 class="font-weight-bold mb-3">Account</h4>
                        <form class="" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6 mb-2"><label>Your Name</label>
                            <input type="text" class="form-control mb-3" placeholder="{{__('Your Name')}}" name="name" value="{{ Auth::user()->name }}">
                          </div>
                          <div class="form-group col-md-6 mb-2">
                            <label>Email</label>
                            <input type="email" class="form-control mb-3" placeholder="{{__('Your Email')}}" name="email" value="{{ Auth::user()->email }}" disabled>

                          </div>
                          <div class="form-group col-md-6 mb-2">
                            <label>New Password</label>
                            <input type="password" class="form-control mb-3" placeholder="{{__('New Password')}}" name="new_password">
                          </div>
                          <div class="form-group col-md-6 mb-2">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control mb-3" placeholder="{{__('Confirm Password')}}" name="confirm_password">
                          </div>

                          <div class="form-group col-md-12 mb-2">
                            <label>Profile Picture</label>
                            <input type="file" name="photo" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                            <label for="file-3" class="mw-100 mb-3">
                                <span></span>
                                <strong>
                                    <i class="fa fa-upload"></i>
                                    {{__('Choose image')}}
                                </strong>
                            </label>
                          </div>
                          <div class="form-group col-12 mx-auto text-center">
                            <button type="submit" class="btn btn-main px-5">{{__('Update Profile')}}</button>
                          </div>
                        </div>
                        <div class="form-box bg-white mt-4">
                            <h4 class="font-weight-bold mb-3">Addresses</h4>

                            <div class="form-box-content p-3">
                                <div class="row gutters-10">
                                    @foreach (Auth::user()->addresses as $key => $address)
                                        <div class="col-lg-6">
                                            <div class="border p-3 pr-5 rounded mb-3 position-relative">
                                                <div class='mb-2'>
                                                    <span class="alpha-6">Address:</span>
                                                    <span class="strong-400 ml-2">{{ $address->address }}</span>
                                                </div>
                                                <div class='mb-2'>
                                                    <span class="alpha-6">Postal Code:</span>
                                                    <span class="strong-400 ml-2">{{ $address->postal_code }}</span>
                                                </div>
                                                <div class='mb-2'>
                                                    <span class="alpha-6">City:</span>
                                                    <span class="strong-400 ml-2">{{ $address->city }}</span>
                                                </div>
                                                <div class='mb-2'>
                                                    <span class="alpha-6">Country:</span>
                                                    <span class="strong-400 ml-2">{{ $address->country }}</span>
                                                </div>
                                                <div class='mb-2'>
                                                    <span class="alpha-6">Phone:</span>
                                                    <span class="strong-400 ml-2">{{ $address->phone }}</span>
                                                </div>
                                                @if ($address->set_default)
                                                    <div class="position-absolute right-0 bottom-0 pr-2 pb-3">
                                                        <span class="badge badge-primary bg-base-1">Default</span>
                                                    </div>
                                                @endif
                                                <div class="dropdown position-absolute right-0 top-0">
                                                    <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                                        <i class="la la-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                        @if (!$address->set_default)
                                                            <a class="dropdown-item" href="{{ route('addresses.set_default', $address->id) }}">Make This Default</a>
                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('addresses.destroy', $address->id) }}">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-lg-6 mx-auto" onclick="add_new_address()">
                                        <div class="border p-3 rounded mb-3 c-pointer text-center bg-light">
                                            <i class="la la-plus la-2x"></i>
                                            <div class="alpha-7">Add New Address</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>

                {{-- <div class="col-lg-9 col-md-12 col-12 mt-lg-0 mt-3">
                    <div class="dashboard-content d-flex align-items-center h-100">
                        <div class="submit-section">
                            <h4 class="font-weight-bold mb-3">Account</h4>
                            <div class="form-row">
                            <form class="" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2">
                                        {{__('Basic info')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Your Name')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your Name')}}" name="name" value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Your Email')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="email" class="form-control mb-3" placeholder="{{__('Your Email')}}" name="email" value="{{ Auth::user()->email }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Photo')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="file" name="photo" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                                <label for="file-3" class="mw-100 mb-3">
                                                    <span></span>
                                                    <strong>
                                                        <i class="fa fa-upload"></i>
                                                        {{__('Choose image')}}
                                                    </strong>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Your Password')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="password" class="form-control mb-3" placeholder="{{__('New Password')}}" name="new_password">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Confirm Password')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="password" class="form-control mb-3" placeholder="{{__('Confirm Password')}}" name="confirm_password">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-styled btn-base-1">{{__('Update Profile')}}</button>
                                </div>

                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2">
                                        {{__('Addresses')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row gutters-10">
                                            @foreach (Auth::user()->addresses as $key => $address)
                                                <div class="col-lg-6">
                                                    <div class="border p-3 pr-5 rounded mb-3 position-relative">
                                                        <div class='mb-2'>
                                                            <span class="alpha-6">Address:</span>
                                                            <span class="strong-400 ml-2">{{ $address->address }}</span>
                                                        </div>
                                                        <div class='mb-2'>
                                                            <span class="alpha-6">Postal Code:</span>
                                                            <span class="strong-600 ml-2">{{ $address->postal_code }}</span>
                                                        </div>
                                                        <div class='mb-2'>
                                                            <span class="alpha-6">City:</span>
                                                            <span class="strong-600 ml-2">{{ $address->city }}</span>
                                                        </div>
                                                        <div class='mb-2'>
                                                            <span class="alpha-6">Country:</span>
                                                            <span class="strong-600 ml-2">{{ $address->country }}</span>
                                                        </div>
                                                        <div class='mb-2'>
                                                            <span class="alpha-6">Phone:</span>
                                                            <span class="strong-600 ml-2">{{ $address->phone }}</span>
                                                        </div>
                                                        @if ($address->set_default)
                                                            <div class="position-absolute right-0 bottom-0 pr-2 pb-3">
                                                                <span class="badge badge-primary bg-base-1">Default</span>
                                                            </div>
                                                        @endif
                                                        <div class="dropdown position-absolute right-0 top-0">
                                                            <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                @if (!$address->set_default)
                                                                    <a class="dropdown-item" href="{{ route('addresses.set_default', $address->id) }}">Make This Default</a>
                                                                @endif
                                                                <a class="dropdown-item" href="{{ route('addresses.destroy', $address->id) }}">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-lg-6 mx-auto" onclick="add_new_address()">
                                                <div class="border p-3 rounded mb-3 c-pointer text-center bg-light">
                                                    <i class="la la-plus la-2x"></i>
                                                    <div class="alpha-7">Add New Address</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('New Address')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('Address')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address')}}" rows="1" name="address" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('Country')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select your country')}}" name="country" required>
                                            @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('City')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your City')}}" name="city" value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('Postal code')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your Postal Code')}}" name="postal_code" value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('Phone')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="{{__('+880')}}" name="phone" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-base-1">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript">
    function add_new_address(){
        $('#new-address-modal').modal('show');
    }
</script>
@endsection
