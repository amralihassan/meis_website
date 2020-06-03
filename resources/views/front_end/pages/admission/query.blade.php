@extends('front_end.index')
@section('styles')
    <link rel="stylesheet" href="{{url('/public/design/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
    <style>
        .item {position: relative;margin: 15px;border-left: 3px dashed antiquewhite;padding: 10px 40px; }
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
        .box{padding: 10px;background-color: #e5eded;border-radius: 10px;color: black;text-align: right;border:1px solid #b1aaaa;}
    </style>
@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{ url('public/design/site/images/bg_2.jpg') }});">
  <div class="overlay"></div>
  <div class="container">
  <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
      <h1 class="mb-2 bread">Follow up the application process</h1>
      <p class="breadcrumbs"><span class="mr-2"><a href="{{url('/home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Admission <i class="ion-ios-arrow-forward"></i></span></p>
      </div>
  </div>
  </div>
</section>
<section>
  <div class="container">
    <br>
    <h3><b>Follow up the application process</b></h3>
    <div id="result" class="hidden"">
        <h4>Application Code : {{$applicationCode}}</h4>
        <h3 id="applicantName" style="color:red;"></h3>

        {{-- load required admission documents--}}
        <div id="admissionDocuments" class="hidden box"  >
            <h4 style="text-align:right;"><u>{{ trans('admission::admission.admissionRequireDocuments') }}</u></h4>
            <ul id="requiredDocuments" class="ol-style ul-class">
            </ul>
        </div>
        <hr>
        {{--step 1--}}
        <div id="admissionTimeline" class="row hidden">
            <div class="col-sm-8 col-xs-12 ">
                <div class="item" >
                    <span id="paidStatus" class="later" ></span>
                    <div>{{ trans('admission::admission.submitApplication') }}</div>
                    <h6 id="paidText"></h6>
                </div>
            </div>
        </div>
        {{--step 2--}}
        <div id="parentInterviewTimeline" class="row hidden">
            <div class="col-sm-8 col-xs-12 ">
                <div class="item" >
                    <span id="parentInterviewStatus" class="later" ></span>
                    <div>{{ trans('admission::admission.parentsInterview') }}</div>
                    <h6 id="parentInterviewText"></h6>
                </div>
            </div>
        </div>
        {{--step 3--}}
        <div id="openAssessmentTimeline" class="row hidden">
            <div class="col-sm-8 col-xs-12 ">
                <div class="item" >
                    <span id="openAssessmentStatus" class="later" ></span>
                    <div>{{ trans('admission::admission.assessmentTest') }}</div>
                    <h6 id="openAssessmentText"></h6>
                    {{-- assessment and reassessment links --}}
                    <div id="assessmentTestLink"></div>
                    <div id="reassessmentTestLink"></div>
                </div>
            </div>
        </div>
        {{--step 4--}}
        <div id="openReAssessmentTimeline" class="hidden">
            <div class="col-sm-8 col-xs-12 ">
                <div class="item" >
                    <span id="openReAssessmentStatus" class="later"></span>
                    <div>{{ trans('admission::admission.reAssessmentTest') }}</div>
                    <h6 id="openReAssessmentText"></h6>

                </div>
            </div>
        </div>
        {{--step 5--}}
        <div id="installementTimeline" class="row hidden">
            <div class="col-sm-8 col-xs-12 ">
                <div class="item" >
                    <span id="installmentStatus" class="later"></span>
                    <div>{{ trans('admission::admission.installmentOne') }}</div>
                    <h6 id="installmentText"></h6>
                    <h6 id="lastDueDate"></h6>
                    <h6 id="installmentDate"></h6>
                </div>
            </div>
        </div>
    </div>
    <div id="message"></div>
  </div>
</section>
@endsection
@section('javascript')
<script src="{{url('public/design/site/js/jquery.min.js')}}"></script>
<script src="{{url('public/design/site/js/jquery-migrate-3.0.1.min.js')}}"></script>

<script>
  $(document).ready(function(){

    (function(){
      var applicationCode = "{{$applicationCode}}";
      $.ajax({
      type:'POST',
      url:'{{route("site.processFilter")}}',
      data: {
                  _method: 'PUT',
                  applicationCode : applicationCode,
                  _token:     '{{ csrf_token() }}'
              },
      dataType:'json',
      success:function(response){
            $('#applicantName').html(response.applicantName);
            $('#assessmentTestLink').html(response.assessmentLink);
            $('#reassessmentTestLink').html(response.reassessmentLink);
            $('#result').removeClass('hidden');
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
          else if (response.data.paid == 'True' && response.data.parentsInterviewDate != null && response.data.parentInterview == 'No'){
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
          else if (response.data.parentsInterviewDate != null && response.data.parentInterview == 'Yes' && response.data.acceptInterview == 'Not Define'){
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
          else if ( response.data.parentInterview == 'Yes' && response.data.acceptInterview == 'Accept' && response.data.assessmentTestDate == null){
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
          else if ( response.data.acceptInterview == 'Accept' && response.data.assessmentTestDate != null && response.data.openAssessment == 'No'){
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
          else if ( response.data.openAssessment == 'Yes' && response.data.assessmentResult == 'Reject' && response.data.reAssessmentMode == 'False'){
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
          else if (response.data.reAssessmentMode == 'True' && response.data.reAssessmentDate == null && response.data.reAssessmentStatus == 'False'){
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
          else if (response.data.reAssessmentMode == 'True' && response.data.reAssessmentDate != null && response.data.reAssessmentStatus == 'False'){
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
          else if ( response.data.reAssessmentMode == 'True' && response.data.reAssessmentStatus == 'True' && response.data.reAssessmentResult == 'Not Define'){
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
          else if ( response.data.reAssessmentMode == 'True' && response.data.reAssessmentStatus == 'True' && response.data.reAssessmentResult == 'Reject'){
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
          else if (response.data.installmentDate == null && response.data.reAssessmentMode == 'True' && response.data.reAssessmentStatus == 'True' && response.data.reAssessmentResult == 'Accept'){
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
          else if ( response.data.installmentDate != null && response.data.installmentStatus == 'False' && response.data.reAssessmentMode == 'False'){
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
          else if ( response.data.installmentDate != null && response.data.installmentStatus == 'False' && response.data.reAssessmentMode == 'True'){
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
          else if ( response.data.installmentDate != null && response.data.installmentStatus == 'True' && response.data.reAssessmentMode == 'False'){
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
          else if ( response.data.installmentDate != null && response.data.installmentStatus == 'True' && response.data.reAssessmentMode == 'True'){
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
                        $('#admissionDocuments').removeClass('hidden');
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

        },
      error:function(){
          $('#result').css('display','none');
          $('#message').html('<div class="alert alert-danger">Invalid application code, <p>Please check the application code .. You can return to the school to confirm it.</p></div>');
        }
      });

    }())
  })
</script>
@endsection
