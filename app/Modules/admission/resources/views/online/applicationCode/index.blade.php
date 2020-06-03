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
            <li class="active">{{ !empty($title)?$title:trans('staff::employee.employeesGate')}}</li>
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
                    <a data-toggle="tab" href="#createApplicationCode">
                        {{trans('admission::admission.createApplicationCode')}}
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container"></div>
                            </div>
                            <div>
                                {{Form::open(['method'=>'POST','id'=>'formData'])}}
                                <table id="dynamic-table" class="table display data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th width="65px">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </th>
                                            <th width="65px">#</th>
                                            <th>{{trans('admission::admission.applicationDate')}}</th>
                                            <th>{{trans('admission::admission.applicantName')}}</th>
                                            <th>{{trans('admission::admission.applicationCode')}}</th>
                                            <th>{{trans('admission::admission.nextGrade')}}</th>
                                            <th>{{trans('admission::admission.nextAcademicYear')}}</th>
                                            <th>{{trans('admission::admission.createAt')}}</th>

                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                </table>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>

                <div id="createApplicationCode" class="tab-pane fade">
                    <!-- validation messages -->
                    <div class="alert alert-danger" style="display: none;">
                        <ul>

                        </ul>
                    </div>
                    <div id="message"></div>
                    <div class="row">
                        <div class="col-xs-12">
                            {{Form::open(['class'=>'form-horizontal','role'=>'from','id'=>'applicationCodeForm'])}}
                                <!-- applicantId -->
                                <div class="form-group">
                                    {{Form::label('applicantId', trans('admission::admission.applicantName'), ['class' => 'col-sm-1 control-label no-padding-right'])}}
                                    <div class="col-sm-2">
                                        {{Form::select('onlineId',[],old('onlineId')?'selected':'',['class'=>'form-control select2' ,'id'=>'applicantId_id'])}}
                                    </div>
                                </div>
                                <!-- save -->
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-1 col-md-11">
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
        $scrollX = false;
        if (window.screen.height < 815) {
            $scrollX = true;
        }
        var myTable = $('.data-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: "{{ route('applicationCodes.index') }}",
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
                                                    url:"{{route('applicationCode.destroy')}}",
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
                {data: 'applicationDate',   name: 'applicationDate'},
                {data: 'applicantName',     name: 'applicantName'},
                {data: 'applicationCode', 	name: 'applicationCode'},
                {data: 'nextGrade', 	    name: 'nextGrade'},
                {data: 'academicYear', 	    name: 'academicYear'},
                {data: 'codeCreate_at', 	name: 'codeCreate_at'},
                {data: 'action', 	        name: 'action', orderable: false, searchable: false},
            ],
            "scrollX": $scrollX,
            columnDefs: [{ visible: false, targets: [6,7] }],
            @include('layouts.datatable.language')
        });
            @include('layouts.datatable.code')
    });

    (function getApplicants()
    {
        $.ajax({
            type:'ajax',
            method:'get',
            url:'{{route("getApplicants")}}',
            dataType:'json',
            success:function(data){
            $('#applicantId_id').html(data);
            }
        });
    }());

    $('#applicationCodeForm').on('submit',function(e){
        e.preventDefault();
        var form_data = new FormData($(this)[0]);
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
                    url:"{{route('applicationCode.store')}}",
                    method:"POST",
                    data:form_data,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    dataType:"json",
                    beforeSend:function(){
                        $('.alert-danger ul').empty();
                        $('.alert-danger').hide();
                    },
                    // display succees message
                    success:function(data)
                    {
                        $('.alert-danger').hide();
                        $('#applicationCodeForm')[0].reset();
                        $('#dynamic-table').DataTable().ajax.reload();
                        $('html, body').animate({ scrollTop: 0 }, 0);

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
                    swal("{{trans('msg.error')}}", "{{trans('msg.fail')}}");
                });
            }
        );
    });

</script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
