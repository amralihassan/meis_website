@extends('layouts.app')
@section('navbar')
	@include('layouts.navbar')
@endsection
@section('content')			
	<div class="page-header">
		<h1>
			{{$title}}
		</h1>
	</div><!-- /.page-header -->	
	<div class="row">
		<div class="col-xs-12">
			{{Form::open(['url'=>'admin/admin/update/'.$admin->id,'method'=>'POST','files'=>true,'class'=>'form-horizontal','role'=>'from'])}}
				<!-- name -->
				<div class="form-group">
					{{Form::label('name', trans('admin.name'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-9">					
						{{Form::text('name',$admin->name, ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>trans('admin.name')])}}			
					</div>
				</div>	
				<!-- mobile -->
				<div class="form-group">
					{{Form::label('mobile', trans('admin.mobile'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-9">					
						{{Form::text('mobile',$admin->mobile, ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>trans('admin.mobile')])}}			
					</div>
				</div>					
				<!-- job -->
				<div class="form-group">
					{{Form::label('job', trans('admin.job'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-9">					
						{{Form::text('job',$admin->job, ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>trans('admin.job')])}}			
					</div>
				</div>					
				<!-- preferredLanguage -->
				<div class="form-group">
					{{Form::label('preferredLanguage', trans('admin.preferredLanguage'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-2">					
						{{Form::select('preferredLanguage',['en'=>trans('admin.engLang'),'ar'=>trans('admin.arbLang')],$admin->preferredLanguage,['class'=>'form-control','id'=>'form-field-select-1'])}}	
					</div>
				</div>					
				<!-- status -->
				<div class="form-group">
					{{Form::label('status', trans('admin.statusAccount'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-2">					
						{{Form::select('status',['enable'=>trans('admin.statusEnable'),'disable'=>trans('admin.statusDisable')],$admin->status,['class'=>'form-control','id'=>'form-field-select-1'])}}	
					</div>
				</div>					
				<!-- email -->
				<div class="form-group">
					{{Form::label('email', trans('admin.email'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-9">					
						{{Form::email('email',$admin->email, ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>trans('admin.email')])}}			
					</div>
				</div>					
				<!-- adminGroupId -->
				<div class="form-group">
					{{Form::label('adminGroupId', trans('admin.groupName'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-2">					
						{{Form::select('adminGroupId',[],null,['class'=>'form-control','placeholder'=>'','id'=>'GroupId'])}}								
					</div>
				</div>					
				<!-- save -->
				<div class="clearfix form-actions">
					<div class="col-md-offset-2 col-md-10">
						{{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}
						&nbsp; &nbsp; &nbsp;
 						{{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.aurl("admins").'"'])}}						
					</div>
				</div>									
			{{Form::close()}}					
		</div><!-- /.col -->
	</div><!-- /.row -->
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection