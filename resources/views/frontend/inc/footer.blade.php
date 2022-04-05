<footer id="footer" class="footer">
    <div class="container">
        @php
            $generalsetting = \App\GeneralSetting::first();
        @endphp
        <div class="row">
            <div class="col-md-6 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center text-sm-left mr-auto">
                <div class="footer-widget">
                    <h4 class="mb-4">
                        <a href="{{route('home')}}">
                        @if($generalsetting->logo != null)
                            <img loading="lazy" src="{{ asset($generalsetting->logo) }}" alt="{{ env('APP_NAME') }}" class="img-fluid">
                        @else
                            <img loading="lazy" src="{{ asset('frontend/assets/images/logo.png') }}" alt="{{ env('APP_NAME') }}" class="img-fluid">
                        @endif
                        </a>
                        {{-- <img src="images/logo.png" alt="Vaxon." class="img-fluid"> --}}
                    </h4>
                    <p class="lead">{{ $generalsetting->description }}</p>
                    <div class="">
                        <p class="mb-0"><strong>Location : </strong>{{ $generalsetting->address }}</p>
                        <p><strong>Support Email : </strong><a href="mailto:{{ $generalsetting->email  }}"> {{ $generalsetting->email  }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-6 mb-5 mb-lg-0 text-center text-sm-left">
                <div class="footer-widget">
                    <h4 class="mb-4">Quick Links</h4>
                    <ul class="pl-0 list-unstyled mb-0"> 
                        <li><a href="{{route('privacypolicy')}}">Privacy Policy</a></li>
                        <li><a href="{{route('terms')}}">Terms and Conditions</a></li>
                        <li><a href="{{route('sellerpolicy')}}">Seller Policy</a></li>
                        <li><a href="{{route('supportpolicy')}}">Support</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-6 mb-5 mb-lg-0 text-center text-sm-left">
                <div class="footer-widget">
                    <h4 class="mb-4">Useful Link</h4>
                    <ul class="pl-0 list-unstyled mb-0">
                        @foreach (\App\Link::all() as $key => $link)
                            <li><a href="{{ $link->url }}">{{ $link->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-6 text-center text-sm-left">
                <div class="footer-widget">
                    <h4 class="mb-4">Connect With Us</h4>
                    
                    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                    <div class="form-group">
                        <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                            @csrf
                                <input type="email" class="form-control mb-3" placeholder="{{__('Your Email Address')}}" name="email" required id="name">
                            
                                <button type="submit" class="btn btn-main mb-3 p-2" tabindex="0">
                                    {{__('Send Us')}}
                                </button>
                        </form>
                    </div>
                    @endif

                    <h5>Call Now : <a href="tel:{{ $generalsetting->phone }}">{{ $generalsetting->phone }}</a></h5>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-btm py-4 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 mx-auto text-center">
                <p class="copyright mb-0">
                    © Copyright Reserved to {{ $generalsetting->site_name }} &amp; made by
                    {{-- @ Copyright Reserved to Clothing-Nepal &amp; made by --}}
                     <a href="https://nextnepal.com/">Next
                        Nepal</a>
                </p>
            </div>
        </div>
    </div>
</div>