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
            <form action="#">
              <div class="form-group mb-4">
                <label for="#">Enter Email Address</label>
                <input type="text" class="form-control" placeholder="Enter Email Address">
              </div>
              <div class="form-group mb-4">
                <label for="#">Enter username</label>
                <a class="float-right" href="">Forget password?</a>
                <input type="text" class="form-control" placeholder="Enter Password">
              </div>
              <div class="form-group mb-4">
                <label for="#">Enter Password</label>
                <input type="text" class="form-control" placeholder="Enter Password">
              </div>
              <div class="form-group">
                <label for="#">Confirm Password</label>
                <input type="text" class="form-control" placeholder="Confirm Password">
              </div>
              <a href="#" class="btn btn-main mt-3 btn-block">Signup</a>
            </form>
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
