    @extends('front_end.index')
    @section('styles')
        <link rel="stylesheet" href="{{url('/public/design/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
    @endsection
    @section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ url('public/design/site/images/bg_2.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
              <h1 class="mb-2 bread">Admission</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="{{url('/home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Admission <i class="ion-ios-arrow-forward"></i></span></p>
            </div>
          </div>
        </div>
      </section>
        <section class="ftco-section contact-section">
            <div class="container">
                <h4 align="center" style="color: #24b724;font-weight: bold">The data has been registered successfully</h4>
                <h6>. The data will be reviewed within 48 hours and you will be contacted by the admission team <a href="{{url('/admission')}}"><i class="fa fa-undo"></i> back</a></h6>
                <h5 style="color: red;font-weight: bold">Note:</h5>
                <h6 style="color: red">Please, keep the following code to hand it to the school representative, so as you can receive the application follow-up code.</h6>
                <h6  style="float: right;margin:15px 0;color: red;font-weight: bold">برجاء الاحتفاظ بالكود التالي لتسليمه إلى ممثل المدرسة ، حتى تتمكن من تلقي رمز متابعة الطلب</h6>
                <br><br>
                <div class="alert alert-primary">
                    <h4>The student's code is : {{ $code }}</h4>
                </div>

            </div>
        </section>
    @endsection
    @section('javascript')
    <script src="{{url('public/design/site/js/jquery.min.js')}}"></script>
    <script src="{{url('public/design/site/js/jquery-migrate-3.0.1.min.js')}}"></script>
    @endsection
