@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Flat Rate Cost')}}</h3>
            </div>
            <form action="{{ route('shipping_configuration.update') }}" method="POST" enctype="multipart/form-data">
            <div class="panel-body">
                @csrf
                <input type="hidden" name="type" value="flat_rate_shipping_cost">
                <div class="form-group">
                    <div class="col-lg-12">
                        <input class="form-control" type="text" name="flat_rate_shipping_cost" value="{{ \App\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value }}">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary" type="submit">{{__('Update')}}</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Note')}}</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


@endsection
