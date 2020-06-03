@extends('layouts.app')
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('sidebar')
    @include('layouts.sidebars.admission')
@endsection
@section('content')
<div class="links">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{aurl()}}">{{trans('admin.dashboard')}}</a>
        </li>
        <li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
    </ul><!-- /.breadcrumb -->
</div>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
