@extends('front_end.index')
@section('styles')
    {{-- calendat --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ url('public/design/site/images/bg_2.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Parents interview calendar</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="{{url('/home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Calendar <i class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
  </section>
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="alert alert-info">
                <h4><b>Application Code : </b>{{request()->segment(3)}}</h4>
                <h6><b>Work hours : </b> From : <u>{{\Carbon\Carbon::parse(settingHelper()->openTime)->isoFormat('h:m a')}}</u> To :
                    <u>{{\Carbon\Carbon::parse(settingHelper()->closeTime)->isoFormat('h:m a')}}</u></h6>

                {!! Form::open(['url'=>'set/parent/interview/store','method'=>'POST']) !!}
                    <input type="hidden" name="module" value="parentInterview">
                    <input type="hidden" name="applicationCode" value="{{request()->segment(3)}}">
                    <div class="form-group">
                        <h6><b>{{trans('admission::admission.setParentInterview')}}</b></h6>

                        <div class="col-sm-3">
                            <p><i>Example : 09/20/2020, 11:30 AM</i></p>
                            <input type="datetime-local" name="start_date" value="" id="startDate" required>
                        </div>
                    </div>
                    <div class="from-group">
                        <div class="col-sm-3">
                            <label for="simple-colorpicker-1">Select the preferred color</label>
                            <input type="color" name="color" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            {{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.submit"),['type' => 'submit','class'=>'btn btn-primary'])}}
                        </div>
                    </div>
                {!! Form::close() !!}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <!-- print all errors -->
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
            </div>

            <div id="calendar"></div>
        </div>
    </section>
@endsection
@section('javascript')
<script>
    $(document).ready(function(){

        $(function()
        {
            $('#calendar').fullCalendar({
                "header"    :{"left":"prev,next today","center":"title","right":"month,agendaWeek,agendaDay"},
                "eventLimit":true,
                "events": "{{route('parentInterview.all')}}",
            });
        }());

    })

</script>
@endsection
