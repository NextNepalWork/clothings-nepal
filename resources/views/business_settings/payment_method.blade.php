@extends('layouts.app')

@section('content')


<div class="row">

    @php
        $esewa=\App\BusinessSetting::where('type','esewa_payment')->exists();
        // dd($esewa);
    @endphp
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Esewa Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="esewa_payment">
                    @if ($esewa)
                    @php
                        $esewa_credentials=\App\BusinessSetting::where('type','esewa_payment')->first()
                    @endphp

                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('ESEWA KEY')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="ESEWA_KEY" value="{{$esewa_credentials->esewa_key}}" placeholder="ESEWA KEY" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('ESEWA SECRET')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="ESEWA_SECRET" value="{{$esewa_credentials->esewa_secret}}" placeholder="ESEWA SECRET" required>
                            </div>
                        </div> 
                    @else
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('ESEWA KEY')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="ESEWA_KEY" value="" placeholder="ESEWA KEY" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('ESEWA SECRET')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="ESEWA_SECRET" value="" placeholder="ESEWA SECRET" required>
                            </div>
                        </div> 
                    @endif
                    

                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
{{-- <div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('VoguePay Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="voguepay">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="VOGUE_MERCHANT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('MERCHANT ID')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="VOGUE_MERCHANT_ID" value="{{  env('VOGUE_MERCHANT_ID') }}" placeholder="MERCHANT ID" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Sandbox Mode')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <label class="switch">
                                <input value="1" name="voguepay_sandbox" type="checkbox" @if (\App\BusinessSetting::where('type', 'voguepay_sandbox')->first()->value == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection
