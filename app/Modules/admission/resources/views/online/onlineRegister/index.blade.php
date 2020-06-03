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
                        <th>{{trans('admission::admission.applicationCode')}}</th>
                        <th>{{trans('admission::admission.applicantName')}}</th>
                        <th>{{trans('admission::admission.fatherFullName')}}</th>
                        <th>{{trans('admission::admission.fatherMobile')}}</th>
                        <th>{{trans('admission::admission.motherName')}}</th>
                        <th>{{trans('admission::admission.nextGrade')}}</th>
                        <th>{{trans('admission::admission.nextAcademicYear')}}</th>

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
            pageLength: 25, // set page records
            ajax: "{{ route('onlineRegister.index') }}",
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
                                                    url:"{{route('onlineRegister.destroy')}}",
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
                {data: 'code',              name: 'code'},
                {data: 'applicantName',     name: 'applicantName'},
                {data: 'fatherFullName', 	name: 'fatherFullName'},
                {data: 'fatherMobile', 		name: 'fatherMobile'},
                {data: 'motherName', 	    name: 'motherName'},
                {data: 'nextGrade', 	    name: 'nextGrade'},
                {data: 'academicYear', 	    name: 'academicYear'},
                {data: 'action', 	        name: 'action', orderable: false, searchable: false},
            ],
            "scrollX": $scrollX,
            columnDefs: [{ visible: false, targets: [7,9] }],

            @include('layouts.datatable.language')
        });
            @include('layouts.datatable.code')
    });
</script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
