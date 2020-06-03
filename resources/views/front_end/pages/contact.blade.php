@extends('front_end.index')
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{ url('public/design/site/images/bg_2.jpg') }});">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <img src="{{asset('public/images/website/'.settingHelper()->logo)}}" style="width:75px;height:75px;margin-left: auto; margin-right: auto;">
          <h1 class="mb-2 bread">Contact Us</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="{{url('/home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
        </div>
      </div>
    </div>
  </section>
<section class="ftco-section contact-section">
    <div class="container">
      <div class="row d-flex mb-5 contact-info">
        <div class="col-md-4 d-flex">
            <div class="bg-light align-self-stretch box p-4 text-center">
                <h3 class="mb-4">Address</h3>
                <p>{{settingHelper()->address}}</p>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="bg-light align-self-stretch box p-4 text-center">
                <h3 class="mb-4">Contact Number</h3>
              <p><a href="tel://1234567920">{{settingHelper()->contact}}</a></p>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="bg-light align-self-stretch box p-4 text-center">
                <h3 class="mb-4">Email Address</h3>
              <p><a href="mailto:{{settingHelper()->email}}">{{settingHelper()->email}}</a></p>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('javascript')
<script src="{{url('public/design/site/js/jquery.min.js')}}"></script>
<script src="{{url('public/design/site/js/jquery-migrate-3.0.1.min.js')}}"></script>
@endsection
