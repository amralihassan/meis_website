@extends('layouts.app')
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="links">
                <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="{{aurl()}}">{{trans('admin.dashboard')}}</a>
                        </li>
                        <li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
                    </ul><!-- /.breadcrumb -->
            </div>
            <div class="col-xs-12">
                <div class="error-container">
                    <div class="well">
                        <h3 class="grey lighter smaller">
                            <span class="blue bigger-125">
                                <i class="ace-icon fa fa-cogs"></i>
                                {{$title}}
                            </span>
                        </h3>
                        <hr />
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <ul class="list-unstyled spaced inline bigger-110 margin-15">
                                    <!-- divisions -->
                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        <a href="{{route('division.index')}}">{{trans('admission::admission.divisions')}}</a>
                                    </li>
                                    <!-- grades -->
                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        <a href="{{route('grade.index')}}">{{trans('admission::admission.grades')}}</a>
                                    </li>
                                    <!-- academicYears -->
                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        <a href="{{route('acadeimc.index')}}">{{trans('admission::admission.academicYears')}}</a>
                                    </li>
                                    <!-- online register message -->
                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        <a href="{{route('onlineRegister.defaultMessages')}}">{{trans('admission::admission.defaultOnlineRegisterMsgs')}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <ul class="list-unstyled spaced inline bigger-110 margin-15">
                                    <!-- admission documents -->
                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        <a href="{{route('admissionDocument.index')}}">{{trans('admission::admission.admissionDocuments')}}</a>
                                    </li>
                                    <!-- documents grade -->
                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        <a href="{{route('documentsGrade.index')}}">{{trans('admission::admission.documentsGrade')}}</a>
                                    </li>
                                    <!-- assessment links -->
                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        <a href="{{route('assessmentLink.index')}}">{{trans('admission::admission.assessmentLinksSetting')}}</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <ul class="list-unstyled spaced inline bigger-110 margin-15">
                                    <!-- holidays -->
                                    {{-- <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        <a href="{{route('hr.holidays')}}">{{trans('staff::staff.holidays')}}</a>
                                    </li>	 --}}

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->

@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
