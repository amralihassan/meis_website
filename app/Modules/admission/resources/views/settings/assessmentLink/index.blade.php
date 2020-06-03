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
                        <a data-toggle="tab" href="#newGrade">
                            {{trans('admission::admission.newAssessmentLink')}}
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
                        @include('admission::settings.assessmentLink.table')
                    </div>

                    <div id="newGrade" class="tab-pane fade">
                        <!-- validation messages -->
                        <div class="alert alert-danger" style="display: none;">
                            <ul>

                            </ul>
                        </div>
                        <div id="message"></div>
                        {{Form::open(['class'=>'form-horizontal','role'=>'from' ,'id'=>'assessmentLinkForm'])}}
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- testName -->
                                <div class="form-group">
                                    {{Form::label('testName', trans('admission::admission.testName'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('testName',old('testName'), ['class'=>'col-xs-10 col-sm-4','required'=>'required'])}}
                                    </div>
                                </div>
                                <!-- testType -->
                                <div class="form-group">
                                    {{Form::label('testType', trans('admission::admission.testType'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                                    <div class="col-sm-3">
                                        {{Form::select('testType',[''=>'-- '.trans('admission::admission.testType').' --','assessment'=>trans('admission::admission.assessment'),'reassessment'=>trans('admission::admission.reassessment')],old('testType')?'selected':'',['class'=>'form-control'])}}
                                    </div>
                                </div>
                                <!-- linkAddress -->
                                <div class="form-group">
                                    {{Form::label('linkAddress', trans('admission::admission.linkAddress'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                                    <div class="col-sm-10">
                                        {{Form::text('linkAddress',old('linkAddress'), ['class'=>'col-xs-10 col-sm-9','required'=>'required'])}}
                                    </div>
                                </div>
                                <!-- grade name -->
                                <div class="form-group">
                                    {{Form::label('gradeId', trans('admission::admission.gradeName'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                                    <div class="col-sm-3">
                                        {{Form::select('gradeId',[],old('gradeId')?'selected':'',['class'=>'form-control','id'=>'grade'])}}
                                    </div>
                                </div>
                                <!-- divisionsId -->
                                <div class="form-group">
                                    {{Form::label('divisionsId', trans('admission::admission.divisionsId'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                                    <div class="col-sm-3">
                                        {{Form::select('divisionsId[]',[],old('divisionsId')?'selected':'',['class'=>'form-control select2','id'=>'divisionId','multiple'=>'multiple'])}}
                                    </div>
                                </div>
                                <!-- status -->
                                <div class="form-group">
                                    {{Form::label('status', trans('admission::admission.status'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                                    <div class="col-sm-3">
                                        {{Form::select('status',['In Active'=>trans('admission::admission.inActive'),'Active'=>trans('admission::admission.active')],old('status')?'selected':'',['class'=>'form-control'])}}
                                    </div>
                                </div>
                                <!-- notes -->
                                <div class="form-group">
                                    {{Form::label('notes', trans('admission::admission.notes'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                                    <div class="col-sm-10">
                                        {!! Form::textarea('notes',old('notes'),['class'=>'col-xs-10 col-sm-9','rows'=>'3']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- save -->
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-2 col-md-10">
                                {{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.save"),['type' => 'submit','class'=>'btn btn-success','id'=>'action'])}}
                            </div>
                        </div>
                        {{Form::close()}}
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
                    ajax: "{{ route('assessmentLink.index') }}",
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
                                                url:"{{route('assessmentLink.destroy')}}",
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
                        {data: 'assessment_links',  name: 'assessment_links'},
                        {data: 'testType',          name: 'testType'},
                        {data: 'grade', 	        name: 'grade'},
                        {data: 'divisionsId', 	    name: 'divisionsId'},
                        {data: 'status', 	        name: 'status'},
                        {data: 'action', 	        name: 'action', orderable: false, searchable: false},
                    ],
                    "scrollX": $scrollX,
                    @include('layouts.datatable.language')
                });
                @include('layouts.datatable.code')
            });
        })
        // insert function
        $('#assessmentLinkForm').on('submit',function(event){
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
                        url:"{{route('assessmentLink.store')}}",
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
                            $('#assessmentLinkForm')[0].reset();
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

        });
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
                                            url:"{{route('assessmentLink.destroy')}}",
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
                    url:'{{route("assessmentGrade.filter")}}',
                    data: {
                        _method: 'PUT',
                        gradeId : gradeId,
                        _token:   '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'check',             name: 'check', orderable: false, searchable: false},
                    {data: 'DT_RowIndex',       name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'assessment_links',  name: 'assessment_links'},
                    {data: 'testType',          name: 'testType'},
                    {data: 'grade', 	        name: 'grade'},
                    {data: 'divisionsId', 	    name: 'divisionsId'},
                    {data: 'status', 	        name: 'status'},
                    {data: 'action', 	        name: 'action', orderable: false, searchable: false},
                ],
                @include('layouts.datatable.language')
            });
            @include('layouts.datatable.code')
        }
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

        (function getDivisions()
        {
            $.ajax({
                type:'ajax',
                method:'get',
                url:'{{route("getDivisions")}}',
                dataType:'json',
                success:function(data){
                    $('#divisionId').html(data);
                }
            });
        }());
    </script>
@endsection
@section('jquery')
    <script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection

