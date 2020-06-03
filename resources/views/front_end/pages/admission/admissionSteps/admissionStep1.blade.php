@extends('front_end.index')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ url('public/design/site/images/bg_2.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <img src="{{asset('public/images/website/'.settingHelper()->logo)}}" style="width:75px;height:75px;margin-left: auto; margin-right: auto;">
                    <h1 class="mb-2 bread">Admission</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{url('/home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Admission <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section contact-section">
        <div class="container">
            <h3 style="font-weight: bold">Step 1: Virtual tour inside the school</h3>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/137857207" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <p>Virtual tour inside the school.  </p>
                    <button class="btn btn-info" onclick="goto()">Next</button>
                </div>
            </div>

        </div>
    </section>

@endsection
@section('javascript')
    <script src="{{url('public/design/site/js/jquery.min.js')}}"></script>
    <script src="{{url('public/design/site/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script>
        function goto()
        {
            window.location.href='{{url("admission-step2")}}';
        }
    </script>
@endsection
