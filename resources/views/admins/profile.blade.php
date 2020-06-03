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
			<li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
		</ul><!-- /.breadcrumb -->
	</div>
	<h1>
		{{$title}}
	</h1>
</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<div id="home" class="tab-pane in active">
				<div class="row">
					<div class="col-xs-12 col-sm-3 center">
						<span class="profile-picture">
							<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="{{asset('public/images/imagesProfile/'.authInfo()->imageProfile)}}" />
						</span>

						<div class="space space-4"></div>
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-9">
						<h4 class="blue">
							<span class="middle">{{authInfo()->name}}</span>
						</h4>

						<div class="profile-user-info">
							<div class="profile-info-row">
								<div class="profile-info-name"> {{trans('admin.email')}} </div>

								<div class="profile-info-value">
									<span>{{authInfo()->email}}</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> {{trans('admin.mobile')}} </div>

								<div class="profile-info-value">
									<span>{{authInfo()->mobile}}</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> {{trans('admin.job')}} </div>

								<div class="profile-info-value">
									<span>{{authInfo()->job}}</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> {{trans('admin.joined')}} </div>

								<div class="profile-info-value">
									<span>2010/06/20</span>
								</div>
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /#home -->
		</div><!-- /.col -->
	</div><!-- /.row -->
	<div class="hr hr-8 dotted"></div>
	<div class="row">
		<div class="col-xs-12">
			{{Form::open(['url'=>'admin/admin/profile','files'=>true,'class'=>'form-horizontal','role'=>'from'])}}					<!-- image profile -->
                <div class="form-group">
                	{{Form::label('imageProfileLabel', trans('admin.imageProfile'), ['class' => 'col-sm-3 control-label no-padding-right','for'=>'form-field-1'])}}
                	<div class="col-sm-4">
						<div class="widget-body">
							<div class="widget-main">
								<div class="form-group">
									<div class="col-xs-12">
										<input type="file" id="id-input-file-3" name="imageProfile"/>
									</div>
								</div>
							</div>
						</div>
                	</div>
				</div>
				<!-- preferredLanguage -->
				<div class="form-group">
					{{Form::label('preferredLanguage', trans('admin.preferredLanguage'), ['class' => 'col-sm-3 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-2">
						{{Form::select('preferredLanguage',['en'=>trans('admin.engLang'),'ar'=>trans('admin.arbLang')],authInfo()->preferredLanguage,['class'=>'form-control','id'=>'form-field-select-1'])}}
					</div>
				</div>
				<!-- skin -->
				<div class="form-group">
					{{Form::label('skin', trans('admin.themeStyle'), ['class' => 'col-sm-3 control-label no-padding-right','for'=>'form-field-1'])}}
					<div class="col-sm-2">
						{{Form::select('skin',['skin-1'=>'skin-1','skin-2'=>'skin-2','skin-3'=>'skin-3','no-skin'=>'no-skin'],authInfo()->skin,['class'=>'form-control','id'=>'styleId'])}}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-3 col-md-9">
						<div class="ace-settings-item">
							<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
							<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
						</div>
						<div class="ace-settings-item">
							<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div class="ace-settings-item">
							<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div class="ace-settings-item">
							<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
							<label class="lbl" for="ace-settings-add-container">
								Inside
								<b>.container</b>
							</label>
						</div>
						<div class="ace-settings-item">
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
							<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
						</div>

						<div class="ace-settings-item">
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
							<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
						</div>

						<div class="ace-settings-item">
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
							<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
						</div>
					</div>
				</div>
				<!-- save -->
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						{{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}
 						{{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.aurl().'"'])}}
					</div>
				</div>
			{{Form::close()}}
		</div><!-- /.col -->
	</div><!-- /.row -->
@endsection
@section('javascript')
<script>
	$('#id-input-file-3,#id-input-file-31').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}

				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
</script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
