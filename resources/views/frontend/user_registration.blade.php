@extends('frontend.layouts.app')

@section('content')
<div class="account section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="login-form border p-5">
            <div class="text-center heading">
              <h2 class="mb-2">Sign Up</h2>
              <p class="lead">Already have an account? <a href="{{route('user.login')}}"> Login now</a></p>
            </div>
            <form role="form" action="{{ route('register') }}" method="POST">
              @csrf
              <div class="form-group mb-4">
                <label for="#">Enter Email Address</label>
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Enter Email Address') }}" name="email">
                  {{-- <span class="input-group-addon">
                      <i class="text-md la la-envelope"></i>
                  </span> --}}
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
              <div class="form-group mb-4">
                <label for="#">Enter username</label>
                <a class="float-right" href="{{ route('password.request') }}">Forget password?</a>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{ __('Enter user name') }}" name="name">
                {{-- <span class="input-group-addon">
                    <i class="text-md la la-user"></i>
                </span> --}}
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group mb-4">
                <label for="#">Enter Password</label>
                {{-- <input type="text" class="form-control" placeholder="Enter Password"> --}}
                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter Password') }}" name="password">
                  {{-- <span class="input-group-addon">
                      <i class="text-md la la-lock"></i>
                  </span> --}}
                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
              <div class="form-group">
                <label for="#">Confirm Password</label>
                {{-- <input type="text" class="form-control" placeholder="Confirm Password"> --}}
                <input type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" name="password_confirmation">
              </div>
              <div class="form-group">
                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}">
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" style="display:block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
              <button type="submit" class="btn btn-main mt-3 btn-block">Signup</button>
            </form>
            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
              <div class="or or--1 mt-3 text-center">
                  <span>or</span>
              </div>
              <div>
              @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                  <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                      <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                  </a>
              @endif
              @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                  <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                      <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                  </a>
              @endif
              @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                  <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4">
                      <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                  </a>
              @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script type="text/javascript">

        var isPhoneShown = true;

        var input = document.querySelector("#phone-code");
        var iti = intlTelInput(input, {
            separateDialCode: true,
            preferredCountries: []
        });

        var countryCode = iti.getSelectedCountryData();


        input.addEventListener("countrychange", function() {
            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);
        });

        $(document).ready(function(){
            $('.email-form-group').hide();
        });

        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').hide();
                $('.email-form-group').show();
                isPhoneShown = false;
                $(el).html('Use Phone Instead');
            }
            else{
                $('.phone-form-group').show();
                $('.email-form-group').hide();
                isPhoneShown = true;
                $(el).html('Use Email Instead');
            }
        }
    </script>
@endsection
