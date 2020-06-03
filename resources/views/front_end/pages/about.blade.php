@extends('front_end.index')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{url('public/design/site/images/bg_2.jpg')}});">
        <div class="overlay"></div>
        <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
            <img src="{{asset('public/images/website/'.settingHelper()->logo)}}" style="width:75px;height:75px;margin-left: auto; margin-right: auto;">
            <h1 class="mb-2 bread">About Us</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="{{url('/home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 course d-lg-flex ftco-animate">
{{--                    <div class="img" style="background-image: url({{ url('public/design/site/images/course-1.jpg') }});"></div>--}}
                    <div class="text  p-4">
                        <h3><a href="#">Vision</a></h3>
                        <p style="text-align: justify">Our vision is to empower students to acquire, demonstrate, articulate and value knowledge and skills that will support them, as life-long learners, to participate in and contribute to the global world and practice the core values of the school: respect, tolerance & inclusion, and excellence.
                            We strive to provide our graduates with an academic foundation that will enable them to gain admission to the colleges or universities of their choice as well as to succeed in those institutions.</p>
                    </div>
                </div>
                <div class="col-md-12 course d-lg-flex ftco-animate">
{{--                    <div class="img" style="background-image: url({{ url('public/design/site/images/course-2.jpg') }});"></div>--}}
                    <div class="text  p-4">
                        <h3><a href="#">Mission</a></h3>
                        <ul>
                            <li style="text-align: justify">We aim to offer a safe, happy place where everyone is known and valued, and where differing needs are acknowledged, accepted and met.
                                We aim to encourage each student to be independent and develop a sense of responsibility for themselves and respect for others in the environment.</li>
                            <li style="text-align: justify">We aim to provide a safe learning environment with a welcoming atmosphere which creates a sense of belonging among the families.</li>
                            <li style="text-align: justify">We maintain an inclusive environment which acknowledges and respects students from diverse family and cultural backgrounds.</li>
                            <li style="text-align: justify">Our statement “DREAM, BELIEVE, ACHIEVE” reflects our understanding and beliefs. We aim to ensure that the students at our school are provided with high-quality learning experiences based on a broad and balanced curriculum.</li>
                        </ul>
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
