@extends('layouts.app')
@section('navbar')
	@include('layouts.navbar')
@endsection
@section('styles')
    <style>      
        .item {position: relative;margin: 15px;border-left: 3px dashed antiquewhite;padding: 10px 40px; }
        .item > span {position: absolute;width: 40px;height: 40px;font-size: 20px; text-align: center;line-height: 40px;
              border-radius: 100%;left: -20px; top: 0;color:white;}
        .item div {font-size: 18px;font-weight: bold;}
        .item p {margin-top: 15px; }
        .done{background: green;}
        .process{background: orange;}
        .later{background: #8a3bbb;}
        .fail{background: red;}
        .ul-class{list-style-type: none;}
        .hidden{display: none}
        .box{padding: 10px;background-color: #e5eded;border-radius: 10px;color: black;text-align: right;border:1px solid #b1aaaa;}
    </style>
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
                        <th>{{trans('admission::admission.applicantName')}}</th>
                        <th>{{trans('admission::admission.applicationCode')}}</th>
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
                ajax: "{{ route('applicationCodes.update') }}",
                columns: [
                {data: 'check',             name: 'check', orderable: false, searchable: false},
                {data: 'DT_RowIndex',       name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'applicantName',     name: 'applicantName'},
                {data: 'applicationCode', 	name: 'applicationCode'},
                {data: 'nextGrade', 	    name: 'nextGrade'},
                {data: 'academicYear', 	    name: 'academicYear'},
                {data: 'action', 	        name: 'action', orderable: false, searchable: false},
                ],
                "scrollX": $scrollX,
                @include('layouts.datatable.language')
            });
                @include('layouts.datatable.code')
        });
    </script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
