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
    {{-- [age content --}}
    <div class="row">
        <div class="col-sm-12">
            {!! Form::label('fromDate',trans('admission::admission.fromDate'), ['class'=>'col-sm-1 control-label no-padding-right']) !!}
            <div class="col-sm-2">
                <div class="form-group">

                    <input type="datetime-local" class="form-control" id="fromDateId">
                </div>
            </div>
            {!! Form::label('fromDate',trans('admission::admission.toDate'), ['class'=>'col-sm-1']) !!}
            <div class="col-sm-2">
                <div class="form-group">
                    <input type="datetime-local" class="form-control" id="toDateId">

                </div>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary btn-sm" onclick="filter();"><i class="fa fa-search"></i> {{ trans('admin.search') }}</button>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div>
                {{Form::open(['id'=>'formData'])}}
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
                        <th>{{trans('admission::admission.applicantName')}}</th>
                        <th>{{trans('admission::admission.applicationCode')}}</th>
                        <th>{{trans('admission::admission.nextGrade')}}</th>
                        <th>{{trans('admission::admission.academicYear')}}</th>
                        <th>{{trans('admission::admission.reassessmentTestDate')}}</th>
                        <th>{{trans('admission::admission.openAssessment')}}</th>
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
                    ajax: "{{ route('online.openReassessment') }}",
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
                        }
                    ],
                    columns: [
                        {data: 'check',                 name: 'check', orderable: false, searchable: false},
                        {data: 'DT_RowIndex',           name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'applicantName',         name: 'applicantName'},
                        {data: 'applicationCode',       name: 'applicationCode'},
                        {data: 'grade', 	            name: 'grade'},
                        {data: 'academicYear', 		    name: 'academicYear'},
                        {data: 'reAssessmentDate',      name: 'reAssessmentDate'},
                        {data: 'reAssessmentMode', 	    name: 'reAssessmentMode'},

                    ],
                    "scrollX": $scrollX,
                    columnDefs: [{ visible: false, targets: [1,5] }],
                    @include('layouts.datatable.language')
                });
                @include('layouts.datatable.code')
            });
        });

        function filter()
        {
            var fromDate = $('#fromDateId').val();
            var toDate = $('#toDateId').val();
            $('#dynamic-table').DataTable().destroy();
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
                    }
                ],
                ajax:{
                    type:'POST',
                    url:'{{route("openReassessment.filter")}}',
                    data: {
                        _method  : 'PUT',
                        fromDate : fromDate,
                        toDate   : toDate,
                        _token   : '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'check',                 name: 'check', orderable: false, searchable: false},
                    {data: 'DT_RowIndex',           name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'applicantName',         name: 'applicantName'},
                    {data: 'applicationCode',       name: 'applicationCode'},
                    {data: 'grade', 	            name: 'grade'},
                    {data: 'academicYear', 		    name: 'academicYear'},
                    {data: 'reAssessmentDate',      name: 'reAssessmentDate'},
                    {data: 'reAssessmentMode', 	    name: 'reAssessmentMode'},
                ],
                @include('layouts.datatable.language')
            });
            @include('layouts.datatable.code')
        }
    </script>
@endsection
@section('jquery')
    <script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
