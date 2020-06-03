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
{{-- page content --}}
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
                    <a data-toggle="tab" href="#newDocument">
                        {{trans('admission::admission.newDocument')}}
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    {{-- grade --}}
                    <div class="col-sm-2">
                        <div class="form-group">
                            {{Form::select('filterByGrade',[],null,['class'=>'form-control ','id'=>'findByGraderId'])}}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <a href='#' class="btn btn-white btn-primary btn-bold" onclick="filter()"><i class='fa fa-search bigger-110 blur'></i> {{ trans('admin.search') }}</a>
                        </div>
                    </div>
                    @include('admission::settings.documentsGrade.table')
                </div>

                <div id="newDocument" class="tab-pane fade">
                    <!-- validation messages -->
                    <div class="alert alert-danger" style="display: none;">
                        <ul>

                        </ul>
                    </div>
                    <div id="message"></div>
                    <div class="row">
                        <div class="col-xs-12">
                            {{Form::open(['class'=>'form-horizontal','role'=>'from' ,'id'=>'documentGradeForm'])}}
                                <!-- grade name -->
                                <div class="form-group">
                                    {{Form::label('gradeId', trans('admission::admission.gradeName'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                                    <div class="col-sm-3">
                                        {{Form::select('gradeId[]',[],old('gradeId')?'selected':'',['class'=>'form-control select2','id'=>'grade','multiple'=>'multiple'])}}
                                    </div>
                                </div>
                                <!-- documentId -->
                                <div class="form-group">
                                    {{Form::label('documentId', trans('admission::admission.documentName'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                                    <div class="col-sm-3">
                                        {{Form::select('documentId[]',[],old('documentId')?'selected':'',['class'=>'form-control select2','id'=>'document','multiple'=>'multiple'])}}
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

		$('#findByGraderId').on('change',function(){
			filter();
		})
		function filter()
		{
			$('#dynamic-table').DataTable().destroy();
			var gradeId 		= $('#findByGraderId').val();
			var myTable = $('#dynamic-table').DataTable({
                    processing: true,
                    serverSide: false,
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
                                                            url:"{{route('documentsGrade.destroy')}}",
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
					          ajax:{
                        type:'POST',
                        url:'{{route("documentsGrade.filter")}}',
                        data: {
                            _method: 'PUT',
                            gradeId : gradeId,
                            _token:   '{{ csrf_token() }}'
                        }
                    },
                    columns: [
              						{data: 'check',             name: 'check', orderable: false, searchable: false},
              						{data: 'DT_RowIndex',       name: 'DT_RowIndex', orderable: false, searchable: false},
              						{data: 'gradeName',         name: 'gradeName'},
              						{data: 'documentName',      name: 'documentName'},
              						{data: 'registrationType',  name: 'registrationType'},
                    ],
                    @include('layouts.datatable.language')
                });
                @include('layouts.datatable.code')
        }
        // insert function
        $('#documentGradeForm').on('submit',function(event){
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
                        url:"{{route('documentsGrade.store')}}",
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
                            $('#documentGradeForm')[0].reset();

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
        $(document).ready(function(){
            // load all grades
            (function getGrades()
            {
                $.ajax({
                type:'ajax',
                method:'get',
                url:'{{route("getGrades")}}',
                dataType:'json',
                success:function(data){
                    $('#grade').html(data);
                    $('#findByGraderId').html(data);
                }
                });
            }());
            // load all documents
            (function getAdmissionDocuments()
            {
                $.ajax({
                type:'ajax',
                method:'get',
                url:'{{route("getAdmissionDocuments")}}',
                dataType:'json',
                success:function(data){
                    $('#document').html(data);
                }
                });
            }());
        })
    </script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
