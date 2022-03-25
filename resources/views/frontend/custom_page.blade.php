@extends('frontend.layouts.app')

@foreach ($pages as $page)
    

@section('meta_title'){{ $page->meta_title }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ asset($page->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($page->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($page->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $page->slug) }}" />
    <meta property="og:image" content="{{ asset($page->meta_img) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($page->unit_price) }}" />
@endsection

@section('content')

<section class="page-header">
    <div class="overly"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="content text-center">
            <h1 class="mb-3">{{$page->title}}</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent justify-content-center">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('custom-pages.show_custom_page', $page->slug)}}"></a> {{$page->title}}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
</section>

<section class="about section">
    <div class="container">
      <div class="row">
        {{-- <div class="col-lg-4 col-sm-6  col-md-6">
          <div class="about-info mb-5 mb-lg-0">
            <img class="img-fluid" src="images/about/about-1.jpg" alt="about-img">
            <h4 class="mt-4">Our Mission</h4>
            <p>Praesent blandit dolorhon quam. In vemi sit amet augue congue elementum. Morbi in ipsum sit amet pede
              facilisis laoreet.</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6">
          <div class="about-info mb-5 mb-lg-0">
            <img class="img-fluid" src="images/about/about-3.jpg" alt="about-img">
            <h4 class="mt-4">Our Vission</h4>
            <p>Lights together to you’re together. You’ll. Form. Moving created one. Darkness whales fourth from own
              moved.</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-6">
          <div class="about-info">
            <img class="img-fluid" src="images/about/about-2.jpg" alt="about-img">
            <h4 class="mt-4">Statement</h4>
            <p>Praesent blandit dolorhon quam. In vemi sit amet augue congue elementum. Morbi in ipsum sit amet pede
              facilisis laoreet.</p>
          </div>
        </div> --}}
        {!! $page->content !!}
      </div>
    </div>
</section>

@endsection
@endforeach