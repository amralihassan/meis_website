@extends('front_end.index')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ url('public/designsite/images/bg_2.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <img src="{{asset('public/images/website/'.settingHelper()->logo)}}" style="width:75px;height:75px;margin-left: auto; margin-right: auto;">
            <h1 class="mb-2 bread">Career</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="{{url('/home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Career <i class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
        </div>
    </section>

  <section>
    <div class="container" id="tourpackages-carousel">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{$title}}
                <br>  <br>
                <a class="btn icon-btn btn-primary" href="{{ url('hr/recruitment/application') }}"><span class="img-circle"></span>{{ trans('staff::employee.applyForJob') }}</a></h2></div>
                @foreach ($vacancies as $vacancy)
                <div class="col-md-4 d-flex">
                    <div class="bg-light align-self-stretch box p-4 text-center">
                        <h3 class="mb-12">{{$vacancy->jobName}}</h3>
                        <p><b>{{ trans('staff::employee.jobType') }}</b> : {{$vacancy->jobType == 'Full'?trans('staff::employee.fullTime'):trans('staff::employee.partTime')}}</p>
                        <p><b>{{ trans('staff::employee.noVacancy') }}</b> : {{$vacancy->noVacancy}}</p>
                        <p><b>{{ trans('staff::employee.noExperience') }}</b> : {{$vacancy->noExperience}}</p>
                        {{Form::button(trans('staff::employee.details'),['class'=>'btn btn-info','onclick'=>'location.href="'.url("hr/recruitment/vacancies/details/$vacancy->id").'"'])}}
                    </div>
                </div>
                @endforeach
        </div><!-- End row -->
    </div><!-- End container -->

  </section>
@endsection
@section('javascript')
<script src="{{url('public/design/site/js/jquery.min.js')}}"></script>
<script src="{{url('public/design/site/js/jquery-migrate-3.0.1.min.js')}}"></script>
@endsection
