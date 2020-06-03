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
						<li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
					</ul><!-- /.breadcrumb -->
			</div>
		<h1>
			{{$title}}
		</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-sm-12">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#home">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							{{$title}}
						</a>
					</li>

					<li>
						<a data-toggle="tab" href="#newAccount">
							{{trans('admin.newAccount')}}
						</a>
					</li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<div class="pull-right">
							<!-- delete -->
							<a href='#' id="btnDelete" class="btn btn-white btn-primary btn-bold" ><i class='fa fa-trash bigger-110 red'></i> {{trans('admin.delete')}}</a>
						</div>
						@include('admins.table')
					</div>

					<div id="newAccount" class="tab-pane fade">
						<!-- validation messages -->
				        <div class="alert alert-danger" style="display: none;">
				            <ul>

				            </ul>
				        </div>
				        <div id="message"></div>
						<div class="row">
							<div class="col-xs-12">
								{{Form::open(['class'=>'form-horizontal','role'=>'from' ,'id'=>'adminForm'])}}
                                    <!-- name -->
                                    <div class="form-group">
                                        {{Form::label('name', trans('admin.name'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-9">
                                            {{Form::text('name',old('name'), ['class'=>'col-xs-10 col-sm-5','placeholder'=>trans('admin.name'),'required'=>'required'])}}
                                        </div>
                                    </div>
                                    <!-- mobile -->
                                    <div class="form-group">
                                        {{Form::label('mobile', trans('admin.mobile'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-9">
                                            {{Form::text('mobile',old('mobile'), ['class'=>'col-xs-10 col-sm-5','placeholder'=>trans('admin.mobile')])}}
                                        </div>
                                    </div>
                                    <!-- job -->
                                    <div class="form-group">
                                        {{Form::label('job', trans('admin.job'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-9">
                                            {{Form::text('job',old('job'), ['class'=>'col-xs-10 col-sm-5','placeholder'=>trans('admin.job')])}}
                                        </div>
                                    </div>
                                    <!-- preferredLanguage -->
                                    <div class="form-group">
                                        {{Form::label('preferredLanguage', trans('admin.preferredLanguage'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-2">
                                            {{Form::select('preferredLanguage',['en'=>trans('admin.engLang'),'ar'=>trans('admin.arbLang')],old('preferredLanguage'),['class'=>'form-control','id'=>'form-field-select-1'])}}
                                        </div>
                                    </div>
                                    <!-- status -->
                                    <div class="form-group">
                                        {{Form::label('status', trans('admin.statusAccount'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-2">
                                            {{Form::select('status',['enable'=>trans('admin.statusEnable'),'disable'=>trans('admin.statusDisable')],old('status'),['class'=>'form-control','id'=>'form-field-select-1'])}}
                                        </div>
                                    </div>
                                    <!-- email -->
                                    <div class="form-group">
                                        {{Form::label('email', trans('admin.email'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-9">
                                            {{Form::email('email',old('email'), ['class'=>'col-xs-10 col-sm-5','placeholder'=>trans('admin.email'),'required'=>'required'])}}
                                        </div>
                                    </div>
                                    <!-- password -->
                                    <div class="form-group">
                                        {{Form::label('password', trans('admin.password'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-9">
                                            {{Form::password('password', ['class'=>'col-xs-10 col-sm-5','placeholder'=>trans('admin.password'),'required'=>'required'])}}
                                        </div>
                                    </div>
                                    <!-- confirm Password -->
                                    <div class="form-group">
                                        {{Form::label('cPassword', trans('admin.confirmPassword'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-9">
                                            {{Form::password('cPassword', ['class'=>'col-xs-10 col-sm-5','placeholder'=>trans('admin.confirmPassword'),'required'=>'required'])}}
                                        </div>
                                    </div>
                                    <!-- adminGroupId -->
                                    <div class="form-group">
                                        {{Form::label('groupName', trans('admin.groupName'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                        <div class="col-sm-2">
                                            {{Form::select('adminGroupId',[],old('adminGroupId')?'selected':'',['class'=>'form-control','placeholder'=>'','id'=>'GroupId'])}}
                                        </div>
                                    </div>

									<!-- save -->
									<div class="clearfix form-actions">
										<div class="col-md-offset-2 col-md-10">
											{{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.save"),['type' => 'submit','class'=>'btn btn-success','id'=>'action'])}}
										</div>
									</div>
								{{Form::close()}}
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div>
				</div>
			</div>
		</div><!-- /.col -->
	</div>

@endsection
@section('javascript')
	<script>
		  $(function () {
		    var myTable = $('.data-table').DataTable({
		        processing: true,
		        serverSide: false,
		        ajax: "{{ route('admin.index') }}",
		        columns: [
		            {data: 'check', name: 'check', orderable: false, searchable: false},
		            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
		            {data: 'name', name: 'name'},
		            {data: 'mobile', 	  name: 'mobile'},
		            {data: 'email', 		  name: 'email'},
					{data: 'job', 	  name: 'job'},
					{data: 'status', 	  name: 'status'},
		            {data: 'action', 	  name: 'action', orderable: false, searchable: false},
		        ],
					@include('layouts.datatable.language')
		    });
				@include('layouts.datatable.code')
		  });
	</script>
	<script>
		// insert function
		$('#adminForm').on('submit',function(event){
			event.preventDefault();
			var form_data = $(this).serialize();
			swal({
					title: "{{trans('msg.saveAsk')}}",
					text: "{{trans('msg.saveConfirmation')}}",
					showCancelButton: true,
					confirmButtonColor: "#87B87F",
					confirmButtonText: "{{trans('msg.yes')}}",
					cancelButtonText: "{{trans('msg.no')}}",
					closeOnConfirm: false,
				},
				function() {
					$.ajax({
						url:"{{route('ajaxdata.admins')}}",
						method:"POST",
						data:form_data,
						dataType:"json",
						beforeSend:function(){
							$('.alert-danger ul').empty();
							$('.alert-danger').hide();
							$('.alert-success').empty();
							$('.alert-success').hide();
						},
						// display succees message
						success:function(data)
						{
							$('.alert-danger').hide();
							$('#adminForm')[0].reset();
							$('#dynamic-table').DataTable().ajax.reload();
						},
						// display validations error in page
						error:function(data_error,exception){
							if (exception == 'error'){
								$('.alert-danger').show();
								$.each(data_error.responseJSON.errors,function(index,value){
									$('.alert-danger ul').append("<li>"+ value +"</li>");
								})
							}
							else{
								$('.alert-danger').hide();
							}
						}
					})
					// display success confirm message
					.done(function(data) {
						swal("{{trans('msg.success')}}", "{{trans('msg.doneInsert')}}", "success");
					})
					// display error message
					.error(function(data) {
						swal("{{trans('msg.error')}}", "{{trans('msg.fail')}}", "error");
					});
				}
			);
		})
		// press delete button
		$('#btnDelete').on('click',function(){
			// event.preventDefault();
			var itemChecked = $('input[class="ace"]:checkbox').filter(':checked').length;
			// alert(itemChecked);
			if (itemChecked > 0) {
				var form_data = $('#formData').serialize();
				swal({
						title: "{{trans('msg.deleteConfirmation')}}",
						text: "{{trans('msg.deleteAsk')}}",
						showCancelButton: true,
						confirmButtonColor: "#D15B47",
						confirmButtonText: "{{trans('msg.yes')}}",
						cancelButtonText: "{{trans('msg.no')}}",
						closeOnConfirm: false,
					},
					function() {
						$.ajax({
							url:"{{route('ajaxdata.deleteAdmins')}}",
							method:"POST",
							data:form_data,
							dataType:"json",
							// display succees message
							success:function(data)
							{
								$('#dynamic-table').DataTable().ajax.reload();
							}
						})
						// display success confirm message
						.done(function(data) {
							swal("{{trans('msg.delete')}}", "{{trans('msg.doneDelete')}}", "success");
						})
						// display error message
						.error(function(data) {
							swal("{{trans('msg.error')}}", "{{trans('msg.fail')}}", "error");
						});
					}
				);
			}	else{
				swal("{{trans('msg.deleteConfirmation')}}", "{{trans('msg.noRecordsSelected')}}", "info");
			}
		});
		// get all admin users
        (function getAdminGroups()
        {
            $.ajax({
            type:'ajax',
            method:'get',
            url:'',
            dataType:'json',
            success:function(data){
                $('#GroupId').html(data);
            }
            });
        }());
	</script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
