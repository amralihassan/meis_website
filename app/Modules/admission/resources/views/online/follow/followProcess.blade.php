@extends('layouts.app')
@section('navbar')
	@include('layouts.navbar')
@endsection
@section('styles')
    <style>
        .item {position: relative;margin: 15px;padding: 10px 40px; }
        .item-right{border-right: 3px dashed antiquewhite}
        .item-left{border-left: 3px dashed antiquewhite}
        .item > span {position: absolute;width: 40px;height: 40px;font-size: 20px; text-align: center;line-height: 40px;
              border-radius: 100%;left: -20px; top: 0;color:white;}
        .item div {font-size: 18px;font-weight: bold;}
        .item p {margin-top: 15px; }
        .done{background: green;}
        .process{background: orange;}
        .later{background: #8a3bbb;}
        .fail{background: red;}
        .ul-class{list-style-type: none;}
        .hidden{display: none}
        h6{line-height: 20px;}
        .box{padding: 10px;background-color: #e5eded;border-radius: 10px;color: black;text-align: right;border:1px solid #b1aaaa;}
    </style>
@endsection
@section('sidebar')
	@include('layouts.sidebars.admission')
@endsection
@section('content')
<div class="page-header">
    <div class="links">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{aurl()}}">{{trans('admin.dashboard')}}</a>
            </li>
            <li class="active">{{ !empty($title)?$title:trans('staff::employee.employeesGate')}}</li>
        </ul><!-- /.breadcrumb -->
    </div>
    <h1>
        {{$title}}
    </h1>
</div><!-- /.page-header -->
{{-- page content --}}
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            {{ trans('admission::admission.findByApplicationCode') }}
            </div>
            <div class="panel-body">
                {{-- input search --}}
                <div class="col-sm-4">
                    <div class="input-group">
                        {!! Form::text('searchText',null, ['class'=>'form-control col-xs-10 col-sm-1' ,'placeholder'=>trans('admission::admission.enterApplicationCode'),'id'=>'searchboxId']) !!}
                        <span class="input-group-btn">
                            <button type="button" id="searchBtn" class="btn btn-primary btn-sm">
                                <span class="ace-icon fa fa-search icon-on-right bigger-110"> </span> {{ trans('admin.search') }}
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h3 id="applicantName" style="color:red;"></h3>
            {{-- assessment and reassessment links --}}
            <div id="assessmentTestLink"></div>
            <div id="reassessmentTestLink"></div>

            <div id="admissionDocuments" class="hidden">
                <h4><u>{{ trans('admission::admission.admissionRequireDocuments') }}</u></h4>
                <ol id="requiredDocuments" class="ol-style">

                </ol>
            </div>
            <hr>
            {{--step 1--}}
            <div id="admissionTimeline" class="row hidden">
                <div class="col-sm-8 col-xs-12 ">
                    <div class="item {{session('lang')=='ar'?'item-right':'item-left'}}" >
                        <span id="paidStatus" class="later" style="{{session('lang')=='ar'?'left:700px;':'left:-20px;'}}"></span>
                        <div>{{ trans('admission::admission.submitApplication') }}</div>
                        <h6 id="paidText"></h6>
                    </div>
                </div>
            </div>
            {{--step 2--}}
            <div id="parentInterviewTimeline" class="row hidden">
                <div class="col-sm-8 col-xs-12 ">
                    <div class="item {{session('lang')=='ar'?'item-right':'item-left'}}" >
                        <span id="parentInterviewStatus" class="later" style="{{session('lang')=='ar'?'left:700px;':'left:-20px;'}}"></span>
                        <div>{{ trans('admission::admission.parentsInterview') }}</div>
                        <h6 id="parentInterviewText"></h6>
                    </div>
                </div>
            </div>
            {{--step 3--}}
            <div id="openAssessmentTimeline" class="row hidden">
                <div class="col-sm-8 col-xs-12 ">
                    <div class="item {{session('lang')=='ar'?'item-right':'item-left'}}" >
                        <span id="openAssessmentStatus" class="later" style="{{session('lang')=='ar'?'left:700px;':'left:-20px;'}}"></span>
                        <div>{{ trans('admission::admission.assessmentTest') }}</div>
                        <h6 id="openAssessmentText"></h6>
                    </div>
                </div>
            </div>
            {{--step 4--}}
            <div id="openReAssessmentTimeline" class="row hidden">
                <div class="col-sm-8 col-xs-12 ">
                    <div class="item {{session('lang')=='ar'?'item-right':'item-left'}}" >
                        <span id="openReAssessmentStatus" class="later" style="{{session('lang')=='ar'?'left:700px;':'left:-20px;'}}"></span>
                        <div>{{ trans('admission::admission.reAssessmentTest') }}</div>
                        <h6 id="openReAssessmentText"></h6>
                    </div>
                </div>
            </div>
            {{--step 5--}}
            <div id="installementTimeline" class="row hidden">
                <div class="col-sm-8 col-xs-12 ">
                    <div class="item {{session('lang')=='ar'?'item-right':'item-left'}}" >
                        <span id="installmentStatus" class="later" style="{{session('lang')=='ar'?'left:700px;':'left:-20px;'}}"></span>
                        <div>{{ trans('admission::admission.installmentOne') }}</div>
                        <h6 id="installmentText"></h6>
                        <h6 id="lastDueDate"></h6>
                        <h6 id="installmentDate"></h6>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.col -->
</div>
@endsection
@section('javascript')
    <script>
        $('#searchBtn').on('click',function(){
            var applicationCode = $('#searchboxId').val();
            $.ajax({
            type:'POST',
            url:'{{route("followProcess.filter")}}',
            data: {
                        _method: 'PUT',
                        applicationCode : applicationCode,
                        _token:     '{{ csrf_token() }}'
                    },
            dataType:'json',
            success:function(response){
                    // applicant name
                $('#applicantName').html(response.applicantName);
                $('#assessmentTestLink').html(response.assessmentLink);
                $('#reassessmentTestLink').html(response.reassessmentLink);
                    var onlineId = response.data.onlineId;
                    //case 1
                    if (response.data.paid == 'False' ){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-male process');
                        $('#parentInterviewStatus').addClass('fa fa-pause-circle-o later');
                        $('#openAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.defaultPaid);
                        $('#parentInterviewText').html(response.data.defaultParentInterview);
                        $('#openAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 2
                    else if (response.data.paid == 'True' && response.data.parentsInterviewDate == null ){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-male process');
                        $('#openAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewBeforeSetDate + '</br>' + '<a href="{{url('')}}'+'/admission/set_parent_interview_date/'+applicationCode+'">{{trans('admission::admission.setDateForParentInterview')}}</a>');
                        $('#openAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 3
                    else if (response.data.paid == 'True' && response.data.parentsInterviewDate != null &&
                        response.data.parentInterview == 'No'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-male process');
                        $('#openAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewSetDate +'</br> '+"{{trans('admission::admission.dateParentInterview')}}"+' : '+ response.data.parentsInterviewDate);
                        $('#openAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 4
                    else if (response.data.parentsInterviewDate != null && response.data.parentInterview == 'Yes' &&
                        response.data.acceptInterview == 'Not Define'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-male process');
                        $('#openAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentAfterInterview);
                        $('#openAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 5
                    else if ( response.data.parentInterview == 'Yes' && response.data.acceptInterview == 'Reject'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-close fail');
                        $('#openAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewRejected);
                        $('#openAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 6
                    else if ( response.data.parentInterview == 'Yes' && response.data.acceptInterview == 'Accept' &&
                        response.data.assessmentTestDate == null){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-male process');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentBeforeSetDate + '</br>' + '<a href="{{url('')}}'+'/admission/set_assessment_test_date/'+applicationCode+'">{{trans('admission::admission.setDateForAssessmentTest')}}</a>');
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 7
                    else if ( response.data.acceptInterview == 'Accept' && response.data.assessmentTestDate != null &&
                        response.data.openAssessment == 'No'){
                        hiddenStatus();
                        // format assessmentTestDate
                            var d       = new Date(response.data.assessmentTestDate);
                            var day     = d.getDate();
                            var month   = d.getMonth()+1;
                            var year    = d.getFullYear();
                            var hour    = d.getHours();
                            var minute    = d.getMinutes();

                            // var date    =  year + ' - ' + month + ' - ' + day;
                            if (day < 10) {
                                day = "0" + day;
                            }
                            if (month < 10) {
                                month = "0" + month;
                            }
                            var dateTime = day + " - " + month + " - " + year + " {{ trans('admission::admission.hour') }} " + hour +':'+minute;
                        // format assessmentTestDate

                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-male process');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentSetDate +'</br> '+"{{trans('admission::admission.dateAssessmentTest')}}"+' : '+ dateTime);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 8
                    else if ( response.data.openAssessment == 'Yes' && response.data.assessmentResult == 'Not Define'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-male process');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.afterAssessment);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 9
                    else if ( response.data.openAssessment == 'Yes' && response.data.assessmentResult == 'Reject' &&
                        response.data.reAssessmentMode == 'False'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-close fail');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentRejected);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 9 => A
                    else if (response.data.reAssessmentMode == 'True' && response.data.reAssessmentDate == null &&
                        response.data.reAssessmentStatus == 'False'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-close fail');
                        $('#openReAssessmentStatus').addClass('fa fa-male process');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentRejected);
                        $('#openReAssessmentText').html(response.data.beforeSetReassessmentDate + '</br>' + '<a href="{{url('')}}'+'/admission/set_reassessment_test_date/'+applicationCode+'">{{trans('admission::admission.setDateForReassessmentTest')}}</a>');
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 9 => B
                    else if (response.data.reAssessmentMode == 'True' && response.data.reAssessmentDate != null &&
                        response.data.reAssessmentStatus == 'False'){
                        hiddenStatus();

                        // format assessmentTestDate
                        var d       = new Date(response.data.reAssessmentDate);
                        var day     = d.getDate();
                        var month   = d.getMonth()+1;
                        var year    = d.getFullYear();
                        var hour    = d.getHours();
                        var minute    = d.getMinutes();

                        // var date    =  year + ' - ' + month + ' - ' + day;
                        if (day < 10) {
                            day = "0" + day;
                        }
                        if (month < 10) {
                            month = "0" + month;
                        }
                        var dateTime = day + " - " + month + " - " + year + " {{ trans('admission::admission.hour') }} " + hour +':'+minute;
                        // format assessmentTestDate

                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-close fail');
                        $('#openReAssessmentStatus').addClass('fa fa-male process');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentRejected);
                        $('#openReAssessmentText').html(response.data.afterSetReassessmentDate +'</br> '+"{{trans('admission::admission.datereAssessmentTest')}}"+' : '+ dateTime);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 9 => C
                    else if ( response.data.reAssessmentMode == 'True' && response.data.reAssessmentStatus == 'True' &&
                        response.data.reAssessmentResult == 'Not Define'){
                        hiddenStatus();

                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-close fail');
                        $('#openReAssessmentStatus').addClass('fa fa-male process');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentRejected);
                        $('#openReAssessmentText').html(response.data.afterReassessmentDone);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 9 => D
                    else if ( response.data.reAssessmentMode == 'True' && response.data.reAssessmentStatus == 'True' &&
                        response.data.reAssessmentResult == 'Reject'){
                        hiddenStatus();

                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-close fail');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-pause-circle-o later');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentRejected);
                        $('#openReAssessmentText').html(response.data.reAssessmentRejected);
                        $('#installmentText').html(response.data.defaultInstallmentMsg);
                    }
                    //case 9 => E
                    else if (response.data.installmentDate == null && response.data.reAssessmentMode == 'True' &&
                        response.data.reAssessmentStatus == 'True' && response.data.reAssessmentResult == 'Accept'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-close fail');
                        $('#openReAssessmentStatus').addClass('fa fa-check done');
                        $('#installmentStatus').addClass('fa fa-male process');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentRejected);
                        $('#openReAssessmentText').html(response.data.reAssessmentAccepeted);
                        $('#installmentText').html(response.data.installmentAfterResultMsg + '</br>' + '<a href="{{url('')}}'+'/admission/set_installment_one_date/'+applicationCode+'">{{trans('admission::admission.setInstallemtDate')}}</a>');
                    }
                    //case 10
                    else if ( response.data.assessmentResult == 'Accept' && response.data.installmentDate == null){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-check done');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-male process');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentAccepted);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.installmentAfterResultMsg + '</br>' + '<a href="{{url('')}}'+'/admission/set_installment_one_date/'+applicationCode+'">{{trans('admission::admission.setInstallemtDate')}}</a>');
                    }
                    //case 11
                    else if ( response.data.installmentDate != null && response.data.installmentStatus == 'False' &&
                        response.data.reAssessmentMode == 'False'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-check done');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-male process');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentAccepted);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.installmentAfterSetDateMsg);
                    }
                    //case 11
                    else if ( response.data.installmentDate != null && response.data.installmentStatus == 'False' &&
                        response.data.reAssessmentMode == 'True'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-close fail');
                        $('#openReAssessmentStatus').addClass('fa fa-check done');
                        $('#installmentStatus').addClass('fa fa-male process');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentRejected);
                        $('#openReAssessmentText').html(response.data.reAssessmentAccepeted);
                        $('#installmentText').html(response.data.installmentAfterSetDateMsg);
                    }
                    //case 12
                    else if ( response.data.installmentDate != null && response.data.installmentStatus == 'True' &&
                        response.data.reAssessmentMode == 'False'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-check done');
                        $('#openReAssessmentStatus').addClass('fa fa-pause-circle-o later');
                        $('#installmentStatus').addClass('fa fa-check done');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentAccepted);
                        $('#openReAssessmentText').html(response.data.defaultOpenAssessment);
                        $('#installmentText').html(response.data.installmentAfterPaiedMsg);
                    }
                    //case 13
                    else if ( response.data.installmentDate != null && response.data.installmentStatus == 'True' &&
                        response.data.reAssessmentMode == 'True'){
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fa fa-check done');
                        $('#parentInterviewStatus').addClass('fa fa-check done');
                        $('#openAssessmentStatus').addClass('fa fa-close fail');
                        $('#openReAssessmentStatus').addClass('fa fa-check done');
                        $('#installmentStatus').addClass('fa fa-check done');
                        // update messages
                        $('#paidText').html(response.data.paidText);
                        $('#parentInterviewText').html(response.data.parentInterviewAccepted);
                        $('#openAssessmentText').html(response.data.assessmentRejected);
                        $('#openReAssessmentText').html(response.data.reAssessmentAccepeted);
                        $('#installmentText').html(response.data.installmentAfterPaiedMsg);
                    }
                    else{
                        hiddenStatus();
                        // update timeline status
                        $('#paidStatus').addClass('fail fa fa-exclamation');
                        $('#parentInterviewStatus').addClass('fail fa fa-exclamation');
                        $('#openAssessmentStatus').addClass('fail fa fa-exclamation');
                        $('#openReAssessmentStatus').addClass('fail fa fa-exclamation');
                        $('#installmentStatus').addClass('fail fa fa-exclamation');
                        // update messages
                        $('#paidText').html('{{trans("admission::admission.invalidProcess")}}');
                        $('#parentInterviewText').html('{{trans("admission::admission.invalidProcess")}}');
                        $('#openAssessmentText').html('{{trans("admission::admission.invalidProcess")}}');
                        $('#openReAssessmentText').html('{{trans("admission::admission.invalidProcess")}}');
                        $('#installmentText').html('{{trans("admission::admission.invalidProcess")}}');
                    }

                    // load required documents
                        if (response.data.assessmentResult == 'Accept' || response.data.reAssessmentResult == 'Accept') {
                            $('#admissionDocuments').removeClass('hidden');
                                // load all required admission documents
                                $.ajax({
                                type:'POST',
                                url:'{{route("getRequiredDocument.byOnlineId")}}',
                                data: {
                                            _method  : 'PUT',
                                            onlineId : onlineId,
                                            _token   :'{{ csrf_token() }}'
                                        },
                                dataType:'json',
                                success:function(data){
                                        $('#requiredDocuments').html(data);
                                    }
                                });
                        }
                        else{
                            $('#admissionDocuments').addClass('hidden');
                        }
                        // show last due date
                        if (response.data.installmentDate === null && response.data.installmentStatus == 'False' && response.data.assessmentResult == 'Accept') {
                            var d       = new Date(response.data.lastDueDate);
                            var day     = d.getDate();
                            var month   = d.getMonth()+1;
                            var year    = d.getFullYear();
                            // var date    =  year + ' - ' + month + ' - ' + day;
                            if (day < 10) {
                                day = "0" + day;
                            }
                            if (month < 10) {
                                month = "0" + month;
                            }
                            var date = day + " / " + month + " / " + year;

                            $('#lastDueDate').html("{{ trans('admission::admission.lastDueDate') }}" + ' : ' +  date);
                        }
                        else{
                            $('#lastDueDate').html('');
                        }
                        // show installment date
                        if (response.data.installmentDate !== null && response.data.installmentStatus == 'False' && response.data.assessmentResult == 'Accept') {
                            var d       = new Date(response.data.installmentDate);
                            var day     = d.getDate();
                            var month   = d.getMonth()+1;
                            var year    = d.getFullYear();
                            // var date    =  year + ' - ' + month + ' - ' + day;
                            if (day < 10) {
                                day = "0" + day;
                            }
                            if (month < 10) {
                                month = "0" + month;
                            }
                            var date = day + " / " + month + " / " + year;

                            $('#installmentDate').html("{{ trans('admission::admission.installmentDate') }}" + ' : ' +  date);
                        }
                        else{
                            $('#installmentDate').html('');
                        }

                    //default status
                    function hiddenStatus()
                    {
                        $('#admissionTimeline').removeClass('hidden');
                        $('#parentInterviewTimeline').removeClass('hidden');
                        $('#openAssessmentTimeline').removeClass('hidden');
                        // open re assessment
                        if (response.data.reAssessmentMode == 'True') {
                            $('#openReAssessmentTimeline').removeClass('hidden');
                            $('#openReAssessmentTimeline').addClass('row');
                        }else{
                            $('#openReAssessmentTimeline').addClass('hidden');
                        }
                        $('#installementTimeline').removeClass('hidden');

                        $('#paidStatus').removeClass();
                        $('#parentInterviewStatus').removeClass();
                        $('#openAssessmentStatus').removeClass();
                        $('#openReAssessmentStatus').removeClass();
                        $('#installmentStatus').removeClass();
                    }

                }
            });

        });

    </script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
