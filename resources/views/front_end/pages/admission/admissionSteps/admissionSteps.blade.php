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
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-8">
                    <h3 style="font-weight: bold">Admission Steps</h3>
                    <div class="form-row">
                        <ol>
                            <li>Step 1: Virtual tour inside the school.</li>
                            <li>Step 2: A virtual meeting with a public relation representative in order to know more about the school details.</li>
                            <li>Step 3: Proceeding will the application filling process + the parent's interview + student's assessment + tuition fees.</li>
                        </ol>
                        <div class="col-md-4 mb-3">
                            <button class="btn btn-primary" onclick="goto();" >Next</button>
                        </div>
                    </div>
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
            window.location.href='{{url("admission-step1")}}';
        }
    </script>
@endsection
