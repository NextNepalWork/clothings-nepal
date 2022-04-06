@extends('layouts.app')

@section('content')

<h3 class="text-center">{{__('Business Related')}}</h3>
<div class="row">
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Coupon System Activation')}}</h3>
            </div>
            <div class="panel-body text-center">
                <label class="switch">
                    <input type="checkbox" onchange="updateSettings(this, 'coupon_system')" <?php if(\App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1) echo "checked";?>>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Pickup Point Activation')}}</h3>
            </div>
            <div class="panel-body text-center">
                <label class="switch">
                    <input type="checkbox" onchange="updateSettings(this, 'pickup_point')" <?php if(\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1) echo "checked";?>>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Email Verification')}}</h3>
            </div>
            <div class="panel-body text-center">
                <label class="switch">
                    <input type="checkbox" onchange="updateSettings(this, 'email_verification')" <?php if(\App\BusinessSetting::where('type', 'email_verification')->first()->value == 1) echo "checked";?>>
                    <span class="slider round"></span>
                </label>
                {{-- <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    You need to configure SMTP correctly to enable this feature. <a href="{{ route('smtp_settings.index') }}">Configure Now</a>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Conversation Activation')}}</h3>
            </div>
            <div class="panel-body text-center">
                <label class="switch">
                    <input type="checkbox" onchange="updateSettings(this, 'conversation_system')" <?php if(\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1) echo "checked";?>>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>

</div>

<h3 class="text-center">{{__('Payment Related')}}</h3>

<div class="row">
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading text-center bord-btm">
                <h3 class="panel-title">{{__('Esewa Payment Activation')}}</h3>
            </div>
            <div class="panel-body">
                <div class="clearfix">
                    <img loading="lazy"  class="pull-left" src="{{ asset('frontend/images/icons/cards/esewa.jpg') }}" height="30">
                    <label class="switch pull-right">
                        <input type="checkbox" onchange="updateSettings(this, 'esewa_payment')" @if(\App\BusinessSetting::where('type', 'esewa_payment')->first()) {{\App\BusinessSetting::where('type', 'esewa_payment')->first()->value==1}} checked @endif>

                        {{-- <input type="checkbox" onchange="updateSettings(this, 'khalti_payment')" @php if(\App\BusinessSetting::where('type', 'khalti_payment')->first()->value == 1) echo "checked"; @endphp> --}}
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="alert text-center" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    You need to configure Esewa correctly to enable this feature. <a href="{{ route('payment_method.index') }}">Configure Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <h3 class="text-center">{{__('Social Media Login')}}</h3>
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Facebook login')}}</h3>
            </div>
            <div class="panel-body text-center">
                <label class="switch">
                    <input type="checkbox" onchange="updateSettings(this, 'facebook_login')" <?php if(\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1) echo "checked";?>>
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    You need to configure Facebook Client correctly to enable this feature. <a href="{{ route('social_login.index') }}">Configure Now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Google login')}}</h3>
            </div>
            <div class="panel-body text-center">
                <label class="switch">
                    <input type="checkbox" onchange="updateSettings(this, 'google_login')" <?php if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1) echo "checked";?>>
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    You need to configure Google Client correctly to enable this feature. <a href="{{ route('social_login.index') }}">Configure Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type){
            if($(el).is(':checked')){
                var value = 1;
            }
            else{
                var value = 0;
            }
            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == '1'){
                    showAlert('success', 'Settings updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
