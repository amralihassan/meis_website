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

{{-- remove button --}}
<div class="form-group">
    <a href='#' class="btn btn-success btn-sm" onclick="newNotification();"><i class='fa fa-bell '></i> {{trans('admin.add')}}</a>	
    <a href='{{ route('read.notifications') }}' class="btn btn-info btn-sm"><i class='fa fa-check '></i> {{trans('admin.readAll')}}</a>	
    <a href='{{ route('delete.notifications') }}' class="btn btn-danger btn-sm"><i class='fa fa-trash'></i> {{trans('admin.reomveAllNotifications')}}</a>	    
</div>


@foreach (auth()->user()->notifications as $notification)
<div class="well well-sm {!! $notification->read_at==null?'red':'grey' !!}"> {!! $notification->read_at==null?'<i class="fa fa-eye"></i>':'<i class="fa fa-check"></i>' !!} {{$notification->data["data"]}} <br> {{ $notification->created_at->addHour(2)->locale('ar')->isoFormat(' dddd, Do MMMM  YYYY, h:mm') }} </div>                
@endforeach  
@if (auth()->user()->notifications->count() == 0)
    <div class="well well-sm">{{ trans('admin.noNotifications') }}</div>
@endif
{{-- new notification --}}
<div id="newNotification" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">				
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="blue bigger">{{trans('admin.addnewNotification')}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- validation messages -->
                    <div class="alert alert-danger classModal" style="display: none;">
                        <ul>

                        </ul>
                    </div>
                    
                    <div class="col-xs-12">
                        {{Form::open(['url'=>'admin/add/notification','method'=>'POST', 'class'=>'form-horizontal','id'=>'frmNotification'])}}								
                            <!-- employee name - id -->
                            <div class="form-group">
                                {{Form::label('emp', trans('staff::employee.employee'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                                <div class="col-sm-3">					
                                    {{Form::select('empId[]',[],null,['class'=>'form-control select2','style'=>'width: 100%','id'=>'empId' ,'multiple'=>'multiple'])}}		
                                </div>
                            </div>  
                            <!-- notification -->
                            <div class="form-group">	
                                {{Form::label('emp', trans('admin.notification'), ['class' => 'col-sm-3 control-label no-padding-right'])}}
                                <div class="col-sm-9">
                                    {{Form::textarea('notification', old('notification'), ['class'=>'form-control','rows'=>'5'])}}				
                                </div>
                            </div>									                                                                
                        				
                    </div><!-- /.col -->
                </div>
            </div>

            <div class="modal-footer">
                    {{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.save"),['type' => 'submit','class'=>'btn btn-success'])}}      	
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin.back')}}</button>  
            </div>
            {{Form::close()}}	
        </div>
    </div>
</div>	

@endsection 
@section('javascript')
    <script>
        $(document).ready(function() {
            (function getEmployees()
            {
                $.ajax({
                type:'ajax',
                method:'get',
                url:'{{route("getEmployees")}}',
                dataType:'json',
                success:function(data){                    
                    $('#empId').html(data);
                }
                });        
            }());	            
        });
        function  newNotification() {
            $('#newNotification').modal({backdrop: 'static', keyboard: false})  
			$('#newNotification').modal('show');  	
        }      
    </script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
