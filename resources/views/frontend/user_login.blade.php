@extends('frontend.layouts.app')
@section('content')
<div class="account section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="login-form border p-5">
            <div class="text-center heading">
              <h2 class="mb-2">Login</h2>
              <p class="lead">Don’t have an account? <a href="{{ route('user.registration') }}">Create a free account</a></p>
            </div>
            <form action="{{ route('login') }}" method="POST" role="form">
                @csrf
                <div class="form-group mb-4">
                    <label for="#">Enter Email</label>
                    <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter Email" value="{{ old('email') }}" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="#">Enter Password</label>
                    <a class="float-right" href="{{ route('password.request') }}">Forget password?</a>
                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter Password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-main mt-3 btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script type="text/javascript">
        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection