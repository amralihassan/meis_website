@extends('layouts.app')
@section('navbar')
    @include('layouts.navbar')
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
            <li>                
                <a href="{{url('admission/online_register/process_page')}}">{{trans('admission::admission.updateApplicationProcess')}}</a>
            </li>	            						
            <li class="active">{{ !empty($title)?$title:trans('staff::employee.employeesGate')}}</li>
        </ul><!-- /.breadcrumb -->
    </div>			
    <h1>
        {{$title}}
    </h1>
</div><!-- /.page-header -->  
{{-- page content --}}

<div class="profile-user-info profile-user-info-striped">
    {{-- applicant name --}}
    <div class="profile-info-row">
        <div class="profile-info-name"> {{ trans('admission::admission.applicantName') }} </div>
        <div class="profile-info-value">
            <span class="editable">{{$processStatus->applicantName}} {{$processStatus->firstName}} {{$processStatus->middleName}} {{$processStatus->lastName}} {{$processStatus->familyName}}</span>
        </div>
    </div>
    {{-- application code --}}
    <div class="profile-info-row">
        <div class="profile-info-name"> {{ trans('admission::admission.applicationCode') }} </div>
        <div class="profile-info-value">
            <span class="editable">{{$processStatus->applicationCode}}</span>
        </div>
    </div>
    {{-- parent interview date --}}
    <div class="profile-info-row">
        <div class="profile-info-name"> {{ trans('admission::admission.parentsInterviewDate') }} </div>
        <div class="profile-info-value">
            <span class="editable">{{$processStatus->parentsInterviewDate != null? \Carbon\Carbon::parse( $processStatus->parentsInterviewDate)->isoFormat('MMMM Do YYYY, h:m a'):''}}</span>
        </div>
    </div>
    {{-- assessment test date --}}
    <div class="profile-info-row">
        <div class="profile-info-name"> {{ trans('admission::admission.assessmentTestDate') }} </div>
        <div class="profile-info-value">
            <span class="editable">{{$processStatus->assessmentTestDate!= null? \Carbon\Carbon::parse( $processStatus->assessmentTestDate)->isoFormat('MMMM Do YYYY, h:m a'):''}}</span>
        </div>
    </div>
    {{-- reassessment test date --}}
    <div class="profile-info-row">
        <div class="profile-info-name"> {{ trans('admission::admission.reassessmentTestDate') }} </div>
        <div class="profile-info-value">
            <span class="editable">{{$processStatus->reAssessmentDate!= null? \Carbon\Carbon::parse( $processStatus->reAssessmentDate)->isoFormat('MMMM Do YYYY, h:m a'):''}}</span>
        </div>
    </div>    
    {{-- last due date --}}
    <div class="profile-info-row">
        <div class="profile-info-name"> {{ trans('admission::admission.lastDueDate') }} </div>
        <div class="profile-info-value">
            <span class="editable">{{$processStatus->lastDueDate!= null? \Carbon\Carbon::parse( $processStatus->lastDueDate)->isoFormat('MMMM Do YYYY, h:m a'):''}}</span>
        </div>
    </div>      
    {{-- installment one date --}}
    <div class="profile-info-row">
        <div class="profile-info-name"> {{ trans('admission::admission.installmentDate') }} </div>
        <div class="profile-info-value">
            <span class="editable">{{$processStatus->installmentDate!= null? \Carbon\Carbon::parse( $processStatus->installmentDate)->isoFormat('MMMM Do YYYY, h:m a'):''}}</span>
        </div>
    </div>
      
</div>

<br>
{{Form::open(['url'=>'admission/online_register/process/update/'.$processStatus->id,'class'=>'form-horizontal','role'=>'from','method'=>'post'])}}   
    <div class="row">
        <div class="col-xs-12">  
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#tab1">
                            <i class="green ace-icon fa fa-home bigger-120"></i>
                            {{$title}}
                        </a>
                    </li>
    
                    <li>
                        <a data-toggle="tab" href="#tab2">
                            {{trans('admission::admission.parentMessages')}}
                        </a>
                    </li>
                </ul>
    
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">	
                        {{-- paid --}}					
                        <div class="form-group">													
                            {{Form::label('paid', trans('admission::admission.paidField'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                            <div class="col-sm-3">					
                                {{Form::select('paid',['False'=>trans('admission::admission.notPaid'),'True'=>trans('admission::admission.paid')],$processStatus->paid,['class'=>'form-control'])}}	
                            </div>
                        </div>
                        {{-- parentInterview --}}
                        <div class="form-group">													
                            {{Form::label('parentInterview', trans('admission::admission.parentInterview'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                            <div class="col-sm-3">					
                                {{Form::select('parentInterview',['No'=>trans('admission::admission.no'),'Yes'=>trans('admission::admission.yes')],$processStatus->parentInterview,['class'=>'form-control'])}}	
                            </div>
                        </div>
                        {{-- acceptInterview --}}
                        <div class="form-group">													
                            {{Form::label('acceptInterview', trans('admission::admission.acceptInterview'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                            <div class="col-sm-3">					
                                {{Form::select('acceptInterview',['Not Define'=>trans('admission::admission.notDefine'),'Reject'=>trans('admission::admission.reject'),'Accept'=>trans('admission::admission.accept')],$processStatus->acceptInterview,['class'=>'form-control'])}}	
                            </div>
                        </div> 
                        {{-- openAssessment --}}
                        <div class="form-group">													
                            {{Form::label('openAssessment', trans('admission::admission.openAssessment'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                            <div class="col-sm-3">					
                                {{Form::select('openAssessment',['No'=>trans('admission::admission.no'),'Yes'=>trans('admission::admission.yes')],$processStatus->openAssessment,['class'=>'form-control'])}}	
                            </div>
                        </div>
                        {{-- assessmentResult --}}
                        <div class="form-group">													
                            {{Form::label('assessmentResult', trans('admission::admission.assessmentResult'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                            <div class="col-sm-3">					
                                {{Form::select('assessmentResult',['Not Define'=>trans('admission::admission.notDefine'),'Reject'=>trans('admission::admission.reject'),'Accept'=>trans('admission::admission.accept')],$processStatus->assessmentResult,['class'=>'form-control'])}}	
                            </div>
                        </div> 
                        {{-- reAssessmentMode --}}
                        <div class="form-group">													
                            {{Form::label('reAssessmentMode', trans('admission::admission.reAssessmentMode'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                            <div class="col-sm-3">					
                                {{Form::select('reAssessmentMode',['False'=>trans('admission::admission.no'),'True'=>trans('admission::admission.yes')],$processStatus->reAssessmentMode,['class'=>'form-control'])}}	
                            </div>
                        </div>
                        {{-- reAssessmentStatus --}}
                        <div class="form-group">													
                            {{Form::label('reAssessmentStatus', trans('admission::admission.reAssessmentStatus'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                            <div class="col-sm-3">					
                                {{Form::select('reAssessmentStatus',['False'=>trans('admission::admission.no'),'True'=>trans('admission::admission.yes')],$processStatus->reAssessmentStatus,['class'=>'form-control'])}}	
                            </div>
                        </div>                        
                        {{-- reAssessmentResult --}}
                        <div class="form-group">													
                            {{Form::label('reAssessmentResult', trans('admission::admission.reAssessmentResult'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                            <div class="col-sm-3">					
                                {{Form::select('reAssessmentResult',['Not Define'=>trans('admission::admission.notDefine'),'Reject'=>trans('admission::admission.reject'),'Accept'=>trans('admission::admission.accept')],$processStatus->reAssessmentResult,['class'=>'form-control'])}}	
                            </div>
                        </div> 
                        {{-- cancel parent interview date --}}
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <label class="pos-rel">
                                <input type="checkbox" class="ace" name="parentsInterviewDate" value="True" {{$processStatus->parentsInterviewDate == null?'':'checked'}}/>
                                    <span class="lbl"> {{ trans('admission::admission.cancelParentInterviewDate') }}</span>
                                </label>    
                            </div> 
                        </div>  
                        {{-- cancel assessment test --}}
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" name="assessmentTestDate" value="True" {{$processStatus->assessmentTestDate == null?'':'checked'}}/>
                                    <span class="lbl"> {{ trans('admission::admission.cancelAssessmentDate') }}</span>
                                </label>    
                            </div> 
                        </div> 
                        {{-- cancel reassessment test --}}
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" name="reAssessmentDate" value="True" {{$processStatus->reAssessmentDate == null?'':'checked'}}/>
                                    <span class="lbl"> {{ trans('admission::admission.cancelreAssessmentDate') }}</span>
                                </label>    
                            </div> 
                        </div>                                                                                                   	                                               	                        					
                    </div>
    
                    <div id="tab2" class="tab-pane fade">
                            <fieldset>
                                <legend>{{ trans('admission::admission.submitApplication') }}</legend>
                                <!-- defaultPaid -->
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        {{Form::label('defaultPaid', trans('admission::admission.defaultPaid'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('defaultPaid',$processStatus->defaultPaid,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div> 
                                </div>
                                <!-- paidText -->
                                <div class="col-xs-12 col-sm-6">                                    
                                    <div class="form-group">
                                        {{Form::label('paidText', trans('admission::admission.paidText'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('paidText',$processStatus->paidText,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>  
                                </div>
                            </fieldset>        
                            <fieldset>
                                <legend>{{ trans('admission::admission.parentsInterview') }}</legend>
                                <!-- defaultParentInterview -->
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        {{Form::label('defaultParentInterview', trans('admission::admission.defaultParentInterview'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('defaultParentInterview',$processStatus->defaultParentInterview,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div> 
                                <!-- parentInterviewBeforeSetDate -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('parentInterviewBeforeSetDate', trans('admission::admission.parentInterviewBeforeSetDate'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('parentInterviewBeforeSetDate', $processStatus->parentInterviewBeforeSetDate, ['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>     
                                </div> 
                                <!-- parentInterviewSetDate -->
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        {{Form::label('parentInterviewSetDate', trans('admission::admission.parentInterviewSetDate'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('parentInterviewSetDate',$processStatus->parentInterviewSetDate,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>   
                                <!-- parentAfterInterview -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('parentAfterInterview', trans('admission::admission.parentAfterInterview'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('parentAfterInterview',$processStatus->parentAfterInterview,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>    
                                <!-- parentInterviewRejected -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('parentInterviewRejected', trans('admission::admission.parentInterviewRejected'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('parentInterviewRejected',$processStatus->parentInterviewRejected,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>     
                                </div>    
                                <!-- parentInterviewAccepted -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('parentInterviewAccepted', trans('admission::admission.parentInterviewAccepted'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('parentInterviewAccepted',$processStatus->parentInterviewAccepted,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>     
                                </div>            
                            </fieldset>
                            <fieldset>
                                <legend>{{ trans('admission::admission.assessmentTest') }}</legend>
                                <!-- defaultOpenAssessment -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('defaultOpenAssessment', trans('admission::admission.defaultOpenAssessment'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('defaultOpenAssessment',$processStatus->defaultOpenAssessment,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>     
                                </div>    
                                <!-- assessmentBeforeSetDate -->
                                <div class="col-xs-12 col-sm-6">                                
                                    <div class="form-group">
                                        {{Form::label('assessmentBeforeSetDate', trans('admission::admission.assessmentBeforeSetDate'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('assessmentBeforeSetDate',$processStatus->assessmentBeforeSetDate,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>     
                                </div>  
                                <!-- assessmentSetDate -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('assessmentSetDate', trans('admission::admission.assessmentSetDate'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('assessmentSetDate',$processStatus->assessmentSetDate,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>     
                                </div>   
                                <!-- afterAssessment -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('afterAssessment', trans('admission::admission.afterAssessment'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('afterAssessment',$processStatus->afterAssessment,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>  
                                <!-- assessmentRejected -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('assessmentRejected', trans('admission::admission.assessmentRejected'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('assessmentRejected',$processStatus->assessmentRejected,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div> 
                                <!-- assessmentAccepted -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('assessmentAccepted', trans('admission::admission.assessmentAccepted'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('assessmentAccepted',$processStatus->assessmentAccepted,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div> 
                            </fieldset>
                            <fieldset>
                                <legend>{{ trans('admission::admission.reAssessmentTest') }}</legend>
                                <!-- beforeSetReassessmentDate -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('beforeSetReassessmentDate', trans('admission::admission.beforeSetReassessmentDate'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('beforeSetReassessmentDate',$processStatus->beforeSetReassessmentDate,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>  
                                <!-- afterSetReassessmentDate -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('afterSetReassessmentDate', trans('admission::admission.afterSetReassessmentDate'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('afterSetReassessmentDate',$processStatus->afterSetReassessmentDate,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>  
                                <!-- afterReassessmentDone -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('afterReassessmentDone', trans('admission::admission.afterReassessmentDone'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('afterReassessmentDone',$processStatus->afterReassessmentDone,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>  
                                <!-- reAssessmentRejected -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('reAssessmentRejected', trans('admission::admission.reAssessmentRejected'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('reAssessmentRejected',$processStatus->reAssessmentRejected,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>  
                                <!-- reAssessmentAccepeted -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('reAssessmentAccepeted', trans('admission::admission.reAssessmentAccepeted'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('reAssessmentAccepeted',$processStatus->reAssessmentAccepeted,['class'=>'form-control','rows'=>'3']) !!}
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
                                        {{Form::label('defaultInstallmentMsg', trans('admission::admission.defaultInstallmentMsg'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('defaultInstallmentMsg',$processStatus->defaultInstallmentMsg,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div> 
                                <!-- installmentAfterResultMsg -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('installmentAfterResultMsg', trans('admission::admission.installmentAfterResultMsg'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('installmentAfterResultMsg',$processStatus->installmentAfterResultMsg,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div> 
                                <!-- installmentAfterSetDateMsg -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('installmentAfterSetDateMsg', trans('admission::admission.installmentAfterSetDateMsg'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('installmentAfterSetDateMsg',$processStatus->installmentAfterSetDateMsg,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>   
                                <!-- installmentAfterPaiedMsg -->
                                <div class="col-xs-12 col-sm-6">                    
                                    <div class="form-group">
                                        {{Form::label('installmentAfterPaiedMsg', trans('admission::admission.installmentAfterPaiedMsg'), ['class' => 'col-sm-4 control-label no-padding-right'])}}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('installmentAfterPaiedMsg',$processStatus->installmentAfterPaiedMsg,['class'=>'form-control','rows'=>'3']) !!}
                                        </div>
                                    </div>    
                                </div>  
                            </fieldset>                                                                                                                                                                         					
                    </div>
                </div>
            </div>                                                                             				
        </div><!-- /.col -->
    </div><!-- /.row -->
    <!-- save -->
    <div class="clearfix form-actions">
        <div class="col-md-offset-2 col-md-10">
            {{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success','id'=>'action'])}}					                                        
        </div>
    </div>	                                             
{{Form::close()}}	
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection