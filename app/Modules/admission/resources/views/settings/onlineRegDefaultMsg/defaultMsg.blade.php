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
            <li>
                <a href="{{url('admission/settings')}}">{{trans('admission::admission.admissionSetting')}}</a>
            </li>									
            <li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
        </ul><!-- /.breadcrumb -->
    </div>			
    <h1>
        {{$title}}
    </h1>
</div><!-- /.page-header -->
{{-- page content --}}
{{Form::open(['url'=>'admission/setting/default/online_register_messages/update','class'=>'form-horizontal','role'=>'from','method'=>'post'])}}   
    <div class="row">

        <!-- durationParentInterview -->
        <div class="form-group">
            {{Form::label('durationParentInterview', trans('admission::admission.durationParentInterview'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
            <div class="col-sm-3">                        
                {{Form::number('durationParentInterview',$msg->durationParentInterview, ['class'=>'col-sm-2 col-xs-12','step'=>'1','min'=>0,'required'=>'required'])}}			
                {{Form::label('minute', trans('admission::admission.minute'), ['class' => 'col-sm-1 col-xs-12 center control-label no-padding-right'])}}                        
            </div>
        </div> 
        <!-- durationAssessmentTest -->
        <div class="form-group">
            {{Form::label('durationAssessmentTest', trans('admission::admission.durationAssessmentTest'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
            <div class="col-sm-3">                        
                {{Form::number('durationAssessmentTest',$msg->durationAssessmentTest, ['class'=>'col-sm-2 col-xs-12','step'=>'1','min'=>0,'required'=>'required'])}}			
                {{Form::label('minute', trans('admission::admission.minute'), ['class' => 'col-sm-1 col-xs-12 center control-label no-padding-right'])}}                        
            </div>
        </div> 
        {{-- allowed days --}}                
        <div class="form-group">
            {{Form::label('allowedDays', trans('admission::admission.allowedDays'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
            <div class="col-sm-3">                        
                {{Form::number('allowedDays',$msg->allowedDays, ['class'=>'col-sm-2 col-xs-12','step'=>'1','min'=>0,'required'=>'required'])}}			
                {{Form::label('minute', trans('admission::admission.day'), ['class' => 'col-sm-1 col-xs-12 center control-label no-padding-right'])}}                        
            </div>
        </div> 
        {{-- off days --}}
        <div class="form-group">
            {{Form::label('offDays', trans('admission::admission.offDays'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
            <div class="col-sm-2">                                                                
            <select name="offDays[]" multiple='multiple' class="form-control select2">                        
                <option {{ preg_match('/\bSaturday\b/', $msg->offDays) != 0 ?'selected':'' }}  value="Saturday">{{ trans('admin.saturday') }}</option>
                <option {{ preg_match('/\bSunday\b/', $msg->offDays) != 0 ?'selected':'' }}  value="Sunday">{{ trans('admin.sunday') }}</option>
                <option {{ preg_match('/\bMonday\b/', $msg->offDays) != 0 ?'selected':'' }}  value="Monday">{{ trans('admin.monday') }}</option>
                <option {{ preg_match('/\bTuesday\b/', $msg->offDays) != 0 ?'selected':'' }}  value="Tuesday">{{ trans('admin.tuesday') }}</option>
                <option {{ preg_match('/\bWednesday\b/', $msg->offDays) != 0 ?'selected':'' }}  value="Wednesday">{{ trans('admin.wednesday') }}</option>
                <option {{ preg_match('/\bThursday\b/', $msg->offDays) != 0 ?'selected':'' }}  value="Thursday">{{ trans('admin.thursday') }}</option>
                <option {{ preg_match('/\bFriday\b/', $msg->offDays) != 0 ?'selected':'' }} value="Friday">{{ trans('admin.friday') }}</option>
            </select>
            </div>
        </div> 
        <fieldset>
            <legend>{{ trans('admission::admission.submitApplication') }}</legend>
            <!-- defaultPaid -->
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    {{Form::label('defaultPaid', trans('admission::admission.defaultPaid'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('defaultPaid',$msg->defaultPaid,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div> 
            </div>
            <!-- paidText -->
            <div class="col-xs-12 col-sm-6">                                    
                <div class="form-group">
                    {{Form::label('paidText', trans('admission::admission.paidText'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('paidText',$msg->paidText,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>  
            </div>
        </fieldset>        
        <fieldset>
            <legend>{{ trans('admission::admission.parentsInterview') }}</legend>
            <!-- defaultParentInterview -->
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    {{Form::label('defaultParentInterview', trans('admission::admission.defaultParentInterview'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('defaultParentInterview',$msg->defaultParentInterview,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div> 
            <!-- parentInterviewBeforeSetDate -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('parentInterviewBeforeSetDate', trans('admission::admission.parentInterviewBeforeSetDate'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('parentInterviewBeforeSetDate', $msg->parentInterviewBeforeSetDate, ['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>     
            </div> 
            <!-- parentInterviewSetDate -->
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    {{Form::label('parentInterviewSetDate', trans('admission::admission.parentInterviewSetDate'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('parentInterviewSetDate',$msg->parentInterviewSetDate,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>   
            <!-- parentAfterInterview -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('parentAfterInterview', trans('admission::admission.parentAfterInterview'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('parentAfterInterview',$msg->parentAfterInterview,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>    
            <!-- parentInterviewRejected -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('parentInterviewRejected', trans('admission::admission.parentInterviewRejected'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('parentInterviewRejected',$msg->parentInterviewRejected,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>     
            </div>    
            <!-- parentInterviewAccepted -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('parentInterviewAccepted', trans('admission::admission.parentInterviewAccepted'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('parentInterviewAccepted',$msg->parentInterviewAccepted,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>     
            </div>            
        </fieldset>
        <fieldset>
            <legend>{{ trans('admission::admission.assessmentTest') }}</legend>
            <!-- defaultOpenAssessment -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('defaultOpenAssessment', trans('admission::admission.defaultOpenAssessment'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('defaultOpenAssessment',$msg->defaultOpenAssessment,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>     
            </div>    
            <!-- assessmentBeforeSetDate -->
            <div class="col-xs-12 col-sm-6">                                
                <div class="form-group">
                    {{Form::label('assessmentBeforeSetDate', trans('admission::admission.assessmentBeforeSetDate'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('assessmentBeforeSetDate',$msg->assessmentBeforeSetDate,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>     
            </div>  
            <!-- assessmentSetDate -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('assessmentSetDate', trans('admission::admission.assessmentSetDate'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('assessmentSetDate',$msg->assessmentSetDate,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>     
            </div>   
            <!-- afterAssessment -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('afterAssessment', trans('admission::admission.afterAssessment'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('afterAssessment',$msg->afterAssessment,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>  
            <!-- assessmentRejected -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('assessmentRejected', trans('admission::admission.assessmentRejected'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('assessmentRejected',$msg->assessmentRejected,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div> 
            <!-- assessmentAccepted -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('assessmentAccepted', trans('admission::admission.assessmentAccepted'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('assessmentAccepted',$msg->assessmentAccepted,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div> 
        </fieldset>
        <fieldset>
            <legend>{{ trans('admission::admission.reAssessmentTest') }}</legend>
            <!-- beforeSetReassessmentDate -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('beforeSetReassessmentDate', trans('admission::admission.beforeSetReassessmentDate'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('beforeSetReassessmentDate',$msg->beforeSetReassessmentDate,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>  
            <!-- afterSetReassessmentDate -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('afterSetReassessmentDate', trans('admission::admission.afterSetReassessmentDate'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('afterSetReassessmentDate',$msg->afterSetReassessmentDate,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>  
            <!-- afterReassessmentDone -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('afterReassessmentDone', trans('admission::admission.afterReassessmentDone'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('afterReassessmentDone',$msg->afterReassessmentDone,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>  
            <!-- reAssessmentRejected -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('reAssessmentRejected', trans('admission::admission.reAssessmentRejected'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('reAssessmentRejected',$msg->reAssessmentRejected,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>  
            <!-- reAssessmentAccepeted -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('reAssessmentAccepeted', trans('admission::admission.reAssessmentAccepeted'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('reAssessmentAccepeted',$msg->reAssessmentAccepeted,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>  
            <div class="clearfix"></div>

        </fieldset>
        <fieldset>
            <legend>{{ trans('admission::admission.installmentOne') }}</legend>
            {{-- installment --}}
            <!-- defaultInstallmentMsg -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('defaultInstallmentMsg', trans('admission::admission.defaultInstallmentMsg'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('defaultInstallmentMsg',$msg->defaultInstallmentMsg,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div> 
            <!-- installmentAfterResultMsg -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('installmentAfterResultMsg', trans('admission::admission.installmentAfterResultMsg'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('installmentAfterResultMsg',$msg->installmentAfterResultMsg,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div> 
            <!-- installmentAfterSetDateMsg -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('installmentAfterSetDateMsg', trans('admission::admission.installmentAfterSetDateMsg'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('installmentAfterSetDateMsg',$msg->installmentAfterSetDateMsg,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>   
            <!-- installmentAfterPaiedMsg -->
            <div class="col-xs-12 col-sm-6">                    
                <div class="form-group">
                    {{Form::label('installmentAfterPaiedMsg', trans('admission::admission.installmentAfterPaiedMsg'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                    <div class="col-sm-9">
                        {!! Form::textarea('installmentAfterPaiedMsg',$msg->installmentAfterPaiedMsg,['class'=>'form-control','rows'=>'3']) !!}
                    </div>
                </div>    
            </div>  
        </fieldset>        

        <div class="clearfix"></div>
        <!-- save -->
        <div class="clearfix form-actions">
            <div class="col-md-offset-1 col-md-11">
                {{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success','id'=>'action'])}}					                                        
            </div>
        </div>                  
                

        
    </div>
{{Form::close()}}
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection