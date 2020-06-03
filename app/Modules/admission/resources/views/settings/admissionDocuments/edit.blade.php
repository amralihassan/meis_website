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
            <li>
                <a href="{{url('admission/setting/admissionDocument')}}">{{trans('admission::admission.admissionDocuments')}}</a>
            </li>            			
            <li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
        </ul><!-- /.breadcrumb -->
    </div>		
    <h1>
        {{$title}}
    </h1>
</div><!-- /.page-header -->

{{-- page content --}}
<div class="row">
    <div class="col-xs-12">
        {{Form::open(['url'=>'admission/setting/admissionDocument/update/'.$doc->id,'class'=>'form-horizontal','role'=>'from' ,'method'=> 'post'])}}
            <!-- arabicDocumentName -->
            <div class="form-group">
                
                {{Form::label('arabicDocumentName', trans('admission::admission.arabicDocumentName'), ['class' => 'col-sm-2 control-label no-padding-right'])}}

                <div class="col-sm-10">					
                    {{Form::text('arabicDocumentName',$doc->arabicDocumentName, ['class'=>'col-xs-10 col-sm-5','required'=>'required'])}}

                </div>
            </div>
            <!-- englishDocumentName -->
            <div class="form-group">
                
                {{Form::label('englishDocumentName', trans('admission::admission.englishDocumentName'), ['class' => 'col-sm-2 control-label no-padding-right'])}}

                <div class="col-sm-10">					
                    {{Form::text('englishDocumentName',$doc->englishDocumentName, ['class'=>'col-xs-10 col-sm-5','required'=>'required'])}}

                </div>
            </div> 
            {{-- registrationType --}}
            <div class="form-group">
                {{Form::label('registrationType', trans('admission::admission.registrationType'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                <div class="col-sm-2">                                                                
                <select name="registrationType[]" multiple='multiple' class="form-control select2">                        
                    <option {{ preg_match('/\bnew\b/', $doc->registrationType) != 0 ?'selected':'' }}  value="new">{{ trans('admission::admission.statusNew') }}</option>
                    <option {{ preg_match('/\btransfer\b/', $doc->registrationType) != 0 ?'selected':'' }}  value="transfer">{{ trans('admission::admission.statusTransfer') }}</option>
                    <option {{ preg_match('/\breturning\b/', $doc->registrationType) != 0 ?'selected':'' }}  value="returning">{{ trans('admission::admission.statusReturning') }}</option>
                    <option {{ preg_match('/\barrival\b/', $doc->registrationType) != 0 ?'selected':'' }}  value="arrival">{{ trans('admission::admission.statusArrival') }}</option>                    
                </select>
                </div>
            </div>
            <!-- notes -->
            <div class="form-group">

                {{Form::label('notes', trans('admission::admission.notes'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                <div class="col-sm-10">					                                        
                    {!! Form::textarea('notes', $doc->notes, ['class'=>'form-control','rows'=>'3']) !!}
                </div>
            </div>					
            <!-- sort -->
            <div class="form-group">
                {{Form::label('sort', trans('admission::admission.sort'), ['class' => 'col-sm-2 control-label no-padding-right',])}}
                <div class="col-sm-2">					
                    {{Form::text('sort',$doc->sort, ['class'=>'col-xs-10 col-sm-5'])}}			
                </div>
            </div>																					
            <!-- save -->
            <div class="clearfix form-actions">
                <div class="col-md-offset-2 col-md-10">
                    {{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}						
                     {{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.url("admission/setting/admissionDocument").'"'])}}						
                </div>
            </div>									
        {{Form::close()}}					
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
