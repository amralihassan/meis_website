@extends('main_report.body_report')
@section('content')
<h3 class="center">{{ trans('admission::admission.applicationCodeForm') }}</h3>
<p>{{ trans('admission::admission.printTextForm') }}</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>{{ trans('admission::admission.applicantName') }}</th>
            <th>{{ trans('admission::admission.fatherFullName') }}</th>
            <th>{{ trans('admission::admission.nextGrade') }}</th>
            <th>{{ trans('admission::admission.nextAcademicYear') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$data->applicantName}}</td>
            <td>{{$data->firstName}} {{$data->middleName}} {{$data->lastName}} {{$data->familyName}}</td>
            <td>{{session('lang')=='ar'?$data->arGrade:$data->enGrade}}</td>
            <td>{{ $data->academicYear }}</td>       
        </tr>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>{{ trans('admission::admission.applicationCode') }}</th>
            <td>{{$data->applicationCode}}</td>
        </tr>
    </thead>

</table>

    
@endsection
@section('javascript')
    <script> window.print();</script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection