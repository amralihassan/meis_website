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
					<a href="{{url('admission/setting/divisions')}}">{{trans('admission::admission.divisions')}}</a>
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
			{{Form::open(['url'=>'admission/setting/divisions/update/'.$devision->id,'class'=>'form-horizontal','role'=>'from' ,'method'=> 'post'])}}
				<!-- arDevision -->
				<div class="form-group">
					{{Form::label('arDevision', trans('admission::admission.arDevision'), ['class' => 'col-sm-2 control-label no-padding-right',])}}
					<div class="col-sm-10">					
						{{Form::text('arDevision',$devision->arDevision, ['class'=>'col-xs-10 col-sm-5'])}}			
					</div>
				</div>	
				<!-- enDevision -->
				<div class="form-group">
					{{Form::label('enDevision', trans('admission::admission.enDevision'), ['class' => 'col-sm-2 control-label no-padding-right',])}}
					<div class="col-sm-10">					
						{{Form::text('enDevision',$devision->enDevision, ['class'=>'col-xs-10 col-sm-5'])}}			
					</div>
				</div>					
				<!-- sort -->
				<div class="form-group">
					{{Form::label('sort', trans('admission::admission.sort'), ['class' => 'col-sm-2 control-label no-padding-right',])}}
					<div class="col-sm-2">					
						{{Form::text('sort',$devision->sort, ['class'=>'col-xs-10 col-sm-5'])}}			
					</div>
				</div>																					
				<!-- save -->
				<div class="clearfix form-actions">
					<div class="col-md-offset-2 col-md-10">
						{{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}						
 						{{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.url("admission/setting/divisions").'"'])}}						
					</div>
				</div>									
			{{Form::close()}}					
		</div><!-- /.col -->
	</div><!-- /.row -->
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection