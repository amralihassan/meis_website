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
					<a href="{{url('admission/setting/grades')}}">{{trans('admission::admission.grades')}}</a>
				</li>								
				<li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
			</ul><!-- /.breadcrumb -->
		</div>			
		<h1>
			{{$title}}
		</h1>
	</div><!-- /.page-header -->	
	
	{{Form::open(['url'=>'admission/setting/grades/update/'.$grade->id,'class'=>'form-horizontal','role'=>'from' ,'method'=> 'post'])}}
	<div class="row">
		<div class="col-xs-12">
			
			<div class="col-xs-12 col-sm-6">
				<!-- arGrade -->
				<div class="form-group">                                    
					{{Form::label('arGrade', trans('admission::admission.arGrade'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('arGrade',$grade->arGrade, ['class'=>'col-xs-10 col-sm-8','required'=>'required'])}}
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<!-- enGrade -->
				<div class="form-group">
					{{Form::label('enGrade', trans('admission::admission.enGrade'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('enGrade',$grade->enGrade, ['class'=>'col-xs-10 col-sm-8','required'=>'required'])}}			
					</div>
				</div>	
			</div>
			<div class="col-xs-12 col-sm-6">
				<!-- arGradeParent -->
				<div class="form-group">                                    
					{{Form::label('arGradeParent', trans('admission::admission.arGradeParent'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('arGradeParent',$grade->arGradeParent, ['class'=>'col-xs-10 col-sm-8','required'=>'required'])}}
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<!-- enGradeParent -->
				<div class="form-group">
					{{Form::label('enGradeParent', trans('admission::admission.enGradeParent'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('enGradeParent',$grade->enGradeParent, ['class'=>'col-xs-10 col-sm-8','required'=>'required'])}}			
					</div>
				</div>	
			</div>
			<div class="col-xs-12 col-sm-6">
				<!-- sort -->
				<div class="form-group">
					{{Form::label('sort', trans('admission::admission.sort'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('sort',$grade->sort, ['class'=>'col-xs-10 col-sm-3'])}}			
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<!-- fromAge -->
				<div class="form-group">
					{{Form::label('enGrade', trans('admission::admission.fromAge'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
					<div class="col-sm-6 ">					
						{{Form::number('fromAgeYears',$grade->fromAgeYears, ['class'=>'col-sm-1 col-xs-12','step'=>'1','min'=>0,'required'=>'required'])}}			
						{{Form::label('fromAgeYears', trans('admission::admission.years'), ['class' => 'col-sm-1 col-xs-12 center control-label no-padding-right'])}}
						{{Form::number('fromAgeMonth',$grade->fromAgemonth, ['class'=>'col-sm-1 col-xs-12','step'=>'1','min'=>0,'required'=>'required'])}}			
						{{Form::label('fromAgeMonth', trans('admission::admission.month'), ['class' => 'col-sm-1 col-xs-12 center control-label no-padding-right'])}}
						{{Form::label('enGrade', trans('admission::admission.toAge'), ['class' => 'col-sm-1 col-xs-12 center control-label no-padding-right'])}}
						{{Form::number('toAgeYears',$grade->toAgeYears, ['class'=>'col-sm-1 col-xs-12 center','step'=>'1','min'=>0,'required'=>'required'])}}			
						{{Form::label('toAgeYears', trans('admission::admission.years'), ['class' => 'col-sm-1 col-xs-12 center control-label no-padding-right'])}}
						{{Form::number('toAgeMonth',$grade->toAgeMonth, ['class'=>'col-sm-1 col-xs-12 center','step'=>'1','min'=>0,'required'=>'required'])}}			
						{{Form::label('toAgeMonth', trans('admission::admission.month'), ['class' => 'col-sm-1 col-xs-12 center control-label no-padding-right'])}}
					</div>
				</div>								
			</div>																				
				
		</div><!-- /.col -->
	</div><!-- /.row -->
	<!-- save -->
	<div class="clearfix form-actions">
		<div class="col-md-offset-2 col-md-10">
			{{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}						
				{{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.url("admission/setting/grades").'"'])}}						
		</div>
	</div>									
{{Form::close()}}	
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection