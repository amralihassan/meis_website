@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{url('/public/design/css/bootstrap-timepicker.min.css')}}" />
@endsection
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
			<li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
		</ul><!-- /.breadcrumb -->
	</div>			
	<h1>
		{{$title}}
	</h1>
</div><!-- /.page-header -->
{{Form::open(['url'=>'admin/setting','files'=>true,'class'=>'form-horizontal','role'=>'from'])}}
	<div class="row">
		<div class="col-xs-12">			
			<!-- siteNameArabic -->
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('siteNameArabic', trans('admin.siteNameArabic'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('siteNameArabic',settingHelper()->siteNameArabic, ['class'=>'col-xs-10 col-sm-12','placeholder'=>trans('admin.siteNameArabic')])}}			
					</div>
				</div>	
			</div>
			<!-- contact -->	
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('contact', trans('admin.contact'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('contact', settingHelper()->contact, ['class'=>'col-xs-10 col-sm-12','placeholder'=>trans('admin.contact')])}}			
					</div>
				</div>						
			</div>
			<!-- siteNameEnglish -->
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('siteNameEnglish', trans('admin.siteNameEnglish'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('siteNameEnglish', settingHelper()->siteNameEnglish, ['class'=>'col-xs-10 col-sm-12','placeholder'=>trans('admin.siteNameEnglish')])}}			
					</div>
				</div>	
			</div>			
			<!-- openTime -->											
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">													
					{{Form::label('openTime', trans('admin.openTime'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-3">					
						<div class="input-group bootstrap-timepicker">
							<input id="timepicker1" type="text" class="form-control" name="openTime" value="{{settingHelper()->openTime}}" required="" />
							<span class="input-group-addon">
								<i class="fa fa-clock-o bigger-110"></i>
							</span>
						</div>											
					</div>
				</div>					
			</div>
			<!-- address -->	
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('address', trans('admin.address'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('address', settingHelper()->address, ['class'=>'col-xs-10 col-sm-12','placeholder'=>trans('admin.address')])}}			
					</div>
				</div>					
			</div>		
			<!-- closeTime -->	
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">													
					{{Form::label('closeTime', trans('admin.closeTime'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-3">					
						<div class="input-group bootstrap-timepicker">
							<input id="timepicker2" type="text" class="form-control" name="closeTime" value="{{settingHelper()->closeTime}}" required="" />
							<span class="input-group-addon">
								<i class="fa fa-clock-o bigger-110"></i>
							</span>
						</div>											
					</div>
				</div>						
			</div>
			<!-- email -->
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('email', trans('admin.email'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('email', settingHelper()->email, ['class'=>'col-xs-10 col-sm-12','placeholder'=>trans('admin.email')])}}			
					</div>
				</div>					
			</div>
			<!-- facebook -->
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					{{Form::label('facebook', trans('admin.facebook'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('facebook', settingHelper()->facebook, ['class'=>'col-xs-10 col-sm-12','placeholder'=>trans('admin.facebook')])}}			
					</div>
				</div>					
			</div>	
			<!-- status -->					
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					{{Form::label('status', trans('admin.status'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-4">					
						{{Form::select('status',['open'=>trans('admin.statusOpen'),'close'=>trans('admin.statusClose')],settingHelper()->status,['class'=>'form-control','id'=>'form-field-select-1'])}}	
					</div>
				</div>					
			</div>									
			<!-- youtube -->	
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('youtube', trans('admin.youtube'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">					
						{{Form::text('youtube', settingHelper()->youtube, ['class'=>'col-xs-10 col-sm-12','placeholder'=>trans('admin.youtube')])}}			
					</div>
				</div>					
			</div>							
			<div class="clearfix"></div>
			<!-- arabicDescription -->
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('arabicDescription', trans('admin.arabicDescription'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">
						{{Form::textarea('arabicDescription', settingHelper()->arabicDescription, ['class'=>'form-control','placeholder'=>trans('admin.arabicDescription'),'rows'=>'3'])}}				
					</div>
				</div>						
			</div>
			<!-- englishDescription -->
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('englishDescription', trans('admin.englishDescription'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">
						{{Form::textarea('englishDescription', settingHelper()->englishDescription, ['class'=>'form-control','rows'=>'3'])}}				
					</div>
				</div>						
			</div>
			<!-- keywords -->
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('keywords', trans('admin.keywords'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">
						{{Form::textarea('keywords', settingHelper()->keywords, ['class'=>'form-control','placeholder'=>trans('admin.keywords'),'rows'=>'3'])}}
					</div>
				</div>					
			</div>
			<!-- messageMaintenance -->
			<div class="col-xs-12 col-sm-6">					
				<div class="form-group">
					{{Form::label('messageMaintenance', trans('admin.messageMaintenance'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-9">
						{{Form::textarea('messageMaintenance', settingHelper()->messageMaintenance, ['class'=>'form-control','placeholder'=>trans('admin.messageMaintenance'),'rows'=>'3'])}}
					</div>
				</div>						
			</div>																		
			<!-- logo -->
			<div class="col-xs-12 col-sm-6">						
				<div class="form-group">
					{{Form::label('logo', trans('admin.logo'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-8">
						<div class="widget-body">
							<div class="widget-main">
								<div class="form-group">
									<div class="col-xs-12">
										<input multiple="" type="file" id="id-input-file-3" name="logo"/>
									</div>
								</div>
							</div>
						</div>	                		
					</div>					
				</div>						
			</div>	
			<!-- icon -->
			<div class="col-xs-12 col-sm-6">						
				<div class="form-group">
					{{Form::label('icon', trans('admin.icon'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
					<div class="col-sm-8">
						<div class="widget-body">
							<div class="widget-main">
								<div class="form-group">
									<div class="col-xs-12">
										<input multiple="" type="file" id="id-input-file-31" name="icon"/>
									</div>
								</div>
							</div>
						</div>	                		
					</div>
				</div>					
			</div>					
		</div>
	</div>
		<!-- save -->
		<div class="clearfix form-actions">
			<div class="col-md-offset-1 col-md-11">
				{{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}						
					{{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.aurl().'"'])}}						
			</div>
		</div>	
	{{Form::close()}}	
@endsection
@section('javascript')
{{-- upload function --}}
<script>
	$('#id-input-file-3,#id-input-file-31').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					,
					preview_error : function(filename, error_code) {

					}
			
				}).on('change', function(){

				});
</script>
@endsection
@section('timepicker')
    @include('layouts.timepicker.timepicker')
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection