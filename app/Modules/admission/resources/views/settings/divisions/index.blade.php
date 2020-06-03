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
                    <a data-toggle="tab" href="#newDevision">
                        {{trans('admission::admission.newDevision')}}
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">						
                    @include('admission::settings.divisions.table')						
                </div>

                <div id="newDevision" class="tab-pane fade">
                    <!-- validation messages -->
                    <div class="alert alert-danger" style="display: none;">
                        <ul>

                        </ul>
                    </div>
                    <div id="message"></div>  						
                    <div class="row">
                        <div class="col-xs-12">
                            {{Form::open(['class'=>'form-horizontal','role'=>'from' ,'id'=>'devisionForm'])}}
                                <!-- arDevision -->
                                <div class="form-group">
                                    
                                    {{Form::label('arDevision', trans('admission::admission.arDevision'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}

                                    <div class="col-sm-10">					
                                        {{Form::text('arDevision',old('arDevision'), ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','required'=>'required'])}}

                                    </div>
                                </div>	
                                <!-- english section -->
                                <div class="form-group">

                                    {{Form::label('enDevision', trans('admission::admission.enDevision'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                    <div class="col-sm-10">					
                                        {{Form::text('enDevision',old('enDevision'), ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','required'=>'required'])}}			
                                    </div>
                                </div>					
                                <!-- sort -->
                                <div class="form-group">
                                    {{Form::label('sort', trans('admission::admission.sort'), ['class' => 'col-sm-2 control-label no-padding-right','for'=>'form-field-1'])}}
                                    <div class="col-sm-2">					
                                        {{Form::text('sort',old('sort'), ['class'=>'col-xs-10 col-sm-5','id'=>'form-field-1'])}}			
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
    	<!-- datatable script -->
	<script>
		$(document).ready(function(){
			$(function () {
				$scrollX = false;
				if (window.screen.height < 815) {            
					$scrollX = true;
				}
				var myTable = $('.data-table').DataTable({
					processing: true,
                    serverSide: false,
                    pageLength: 25, 
					ajax: "{{ route('division.index') }}",
					dom: 'Bfrtip',
					buttons: [
							{
								"extend": "colvis",
								"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
								"className": "btn btn-white btn-primary btn-bold",
								columns: ':not(:first):not(:last)'
							},
							{
								"extend": "copy",
								exportOptions: {
									columns: ':visible'
								},
								"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
								"className": "btn btn-white btn-primary btn-bold"
							},
							{
								"extend": "csv",
								exportOptions: {
									columns: ':visible'
								},
								"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
								"className": "btn btn-white btn-primary btn-bold"
							},
							{
								"extend": "excel",
								exportOptions: {
									columns: ':visible'
								},
								"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
								"className": "btn btn-white btn-primary btn-bold"
							},
							{
								"extend": "print",
								exportOptions: {
									columns: ':visible'
								},
								"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
								"className": "btn btn-white btn-primary btn-bold",
								autoPrint: true,
								message: "<h2>"+$('#empId option:selected').text()+"</h2>"
							},
							{
								"text": "<i class='fa fa-trash bigger-110 red'></i> <span class='hidden'>Delete Records</span>",
								"className": "btn btn-white btn-primary btn-bold",
								action: function ( e, dt, node, config ) {
											var itemChecked = $('input[class="ace"]:checkbox').filter(':checked').length;                    
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
															url:"{{route('division.destroy')}}",
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
										}
							}                          	  
						],  				
					columns: [
						{data: 'check',             name: 'check', orderable: false, searchable: false},	
						{data: 'DT_RowIndex',       name: 'DT_RowIndex', orderable: false, searchable: false},		            	            
						{data: 'arDevision',        name: 'arDevision'},
						{data: 'enDevision', 	    name: 'enDevision'},
						{data: 'sort', 		        name: 'sort'},
						{data: 'action', 	        name: 'action', orderable: false, searchable: false},
					],
					"scrollX": $scrollX,				
					@include('layouts.datatable.language')					        
				});
				@include('layouts.datatable.code')
		  });
		})
			// insert function
		$('#devisionForm').on('submit',function(event){
			event.preventDefault();
			var form_data = $(this).serialize();            
            swal({
					title: "{{trans('msg.saveConfirmation')}}",
					text: "{{trans('msg.saveAsk')}}",								
					showCancelButton: true,
					confirmButtonColor: "#87B87F",
					confirmButtonText: "{{trans('msg.yes')}}",
					cancelButtonText: "{{trans('msg.no')}}",
					closeOnConfirm: false,					
				},
				function() {
					$.ajax({
						url:"{{route('division.store')}}",
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
							$('#devisionForm')[0].reset();
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
	</script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection