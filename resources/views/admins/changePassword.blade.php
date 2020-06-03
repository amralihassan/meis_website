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
			{{Form::open(['url'=>'admin/update/password','method'=> 'post','files'=>true,'class'=>'form-horizontal','role'=>'from'])}}
				<!-- name -->
				<div class="form-group">
					{{Form::label('name', trans('admin.name'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-10">					
						{{Form::text('name',$admin->name, ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>trans('admin.name'),'readonly'=>'readonly'])}}			
					</div>
				</div>					
				<!-- password -->
				<div class="form-group">
					{{Form::label('password', trans('admin.password'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-10">					
						{{Form::password('password', ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>trans('admin.password'),'required'=>'required'])}}			
					</div>
				</div>				
				<!-- confirm Password -->
				<div class="form-group">
					{{Form::label('cPassword', trans('admin.confirmPassword'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-10">					
						{{Form::password('cPassword', ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>trans('admin.confirmPassword'),'required'=>'required'])}}			
					</div>
				</div>	
				
				<!-- save -->
				<div class="clearfix form-actions">
					<div class="col-md-offset-2 col-md-10">
						{{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}		
 						{{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.aurl().'"'])}}						
					</div>
				</div>									
			{{Form::close()}}					
		</div><!-- /.col -->
	</div><!-- /.row -->

@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection