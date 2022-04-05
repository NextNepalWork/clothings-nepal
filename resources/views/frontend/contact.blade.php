@extends('frontend.layouts.app')

@section('content')


<!--search overlay end-->
<section class="page-header">
<div class="overly"></div>
<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="content text-center">
        <h1 class="mb-3">Contact Us</h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent justify-content-center">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('contact')}}">Contact Us</a></li>
            </ol>
        </nav>
        </div>
    </div>
    </div>
</div>
</section>

<section class="contact-section section">
    <div class="container">
        <div class="row">
        <!-- Contact Details -->
        <div class="contact-details col-md-6">
            <h3 class="mb-4">Our Company</h3>
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad quo quia cupiditate, dolore
            possimus quidem maxime, neque beatae. Fuga maxime quos recusandae ratione earum atque, quam sunt dolorem
            illum dolor.</p>

            <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h4 class="mb-4">Corporate Office</h4>
                <ul class="contact-short-info list-unstyled">
                <li>
                    <i class="tf-ion-ios-home mr-3"></i>
                    <span>{{$info->address}}</span>
                </li>
                <li>
                    <a href="tel:{{$info->phone}}" class="text-dark">
                        <i class="tf-ion-android-phone-portrait mr-3"></i>
                        <span>{{$info->phone}}</span>
                    </a>
                </li>
                <li>
                    <a href="mailto:{{$info->email}}" class="text-dark">
                        <i class="tf-ion-android-mail mr-3"></i>
                        <span>{{$info->email}}</span>
                    </a>
                </li>
                </ul>
            </div>

            </div>
        </div>
        <!-- Contact Form -->
        <div class="contact-form col-lg-6 ">
            <h3 class="mb-4">Send us an Email:</h3>

            <form id="contact-form" method="post" action="{{route('send-mail')}}">
                @csrf
            <div class="row">
                <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" placeholder="Your Name" class="form-control" name="name" id="name">
                </div>
                </div>

                <div class="col-lg-6">
                <div class="form-group">
                    <input type="email" placeholder="Your Email" class="form-control" name="email" id="email">
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" placeholder="Subject" class="form-control" name="subject" id="subject">
                </div>
                </div>

                <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" placeholder="Phone" class="form-control" name="phone" id="phone">
                </div>
                </div>
            </div>

            <div class="form-group">
                <textarea rows="6" placeholder="Message" class="form-control" name="message" id="message"></textarea>
            </div>

            <div class="mt-4">
                <input type="submit" id="contact-submit" class="btn btn-black btn-small" value="Send Message">
            </div>
            </form>
        </div>
        <!-- ./End Contact Form -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
  <!-- Google Map -->

  <div class="map">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14130.946795029693!2d85.34463115!3d27.694531700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1640601822243!5m2!1sen!2snp"
      width="100%" height="300px" class="border-0" loading="lazy"></iframe>
  </div>

  <!-- Google Map Ends -->

@endsection


