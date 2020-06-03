@extends('layouts.app')
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('content')
<div class="page-header">
    <div class="links">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{aurl()}}">{{trans('admin.dashboard')}}</a>
            </li>							
            
        </ul><!-- /.breadcrumb -->
    </div>			
</div><!-- /.page-header -->  
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
