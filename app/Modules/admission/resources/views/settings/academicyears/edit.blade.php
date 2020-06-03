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
	<div class="row">
		<div class="col-xs-12">
			{{Form::open(['url'=>'admission/setting/academicyears/update/'.$academicyear->id,'class'=>'form-horizontal','role'=>'from' ,'method'=> 'post'])}}
				<!-- academicYear -->
				<div class="form-group">
					{{Form::label('academicYear', trans('admission::admission.academicYear'), ['class' => 'col-sm-2 control-label no-padding-right',])}}
					<div class="col-sm-10">					
						{{Form::text('academicYear',$academicyear->academicYear, ['class'=>'col-xs-10 col-sm-5'])}}			
					</div>
				</div>	
				<!-- startFrom -->
				<div class="form-group">
					{{Form::label('startFrom', trans('admission::admission.startFrom'), ['class' => 'col-sm-2 control-label no-padding-right',])}}
					<div class="col-sm-5">					
						{{Form::date('startFrom',$academicyear->startFrom, ['class'=>'col-xs-10 col-sm-5'])}}			
					</div>
				</div>					
				<!-- endFrom -->
				<div class="form-group">
					{{Form::label('endFrom', trans('admission::admission.endFrom'), ['class' => 'col-sm-2 control-label no-padding-right',])}}
					<div class="col-sm-5">					
						{{Form::date('endFrom',$academicyear->endFrom, ['class'=>'col-xs-10 col-sm-5'])}}			
					</div>
				</div>																					
				<!-- save -->
				<div class="clearfix form-actions">
					<div class="col-md-offset-2 col-md-10">
						{{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}						
 						{{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.url("admission/setting/grades").'"'])}}						
					</div>
				</div>									
			{{Form::close()}}					
		</div><!-- /.col -->
	</div><!-- /.row -->
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection