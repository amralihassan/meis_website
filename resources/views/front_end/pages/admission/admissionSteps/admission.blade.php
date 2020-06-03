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
            <h3 style="font-weight: bold">Follow up the application process</h3>
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-6">
                    <p>Dear Parent/Guardian,</p>
                    <p>Welcome to our school's Admission Center. Please use this form to apply for your child's admission to our school. We need complete and accurate information about the student, so make sure you fill out all fields. School Admission Forms are processed within 48 hours. You will receive an email confirmation when we process your application.</p>
                <button class="btn btn-primary" onclick="window.location.href='{{url("admission-steps")}}'" >Apply Now</button>

                </div>
                <div class="col-md-6">
                    <h3>Follow up the application process</h3>
                    <p>Kindly, enter the application code which you received from the school representative.</p>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <input type="text" class="form-control" placeholder="Application Code" required id="applicationCode">
                            <br>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <button class="btn btn-primary" onclick="goto();" >Submit</button>
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
    {   if ($('#applicationCode').val() == '') {
        alert('Please enter the application code that you received from the school');
        return;
    }
        window.location.href='{{url("admission/query")}}'+'/'+$('#applicationCode').val();
    }
</script>
@endsection
