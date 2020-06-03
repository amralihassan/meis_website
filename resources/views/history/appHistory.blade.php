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
			{{-- department --}}
			<div class="col-sm-2">					
				{{trans('admin.department')}}
				{{Form::select('findByDepartment',['IT'=>'IT','HR'=>'HR','Students Affairs'=>'Students Affairs','Security Gate'=>'Security Gate','..'=>'..'],null,['class'=>'form-control ','id'=>'findByDepartmentId'])}}		
			</div>
			{{-- action --}}
			<div class="col-sm-2">	
				{{trans('admin.action')}}				
				{{Form::select('findByAction',['Insert'=>'Insert','Update'=>'Update','Delete'=>'Delete','Import'=>'Import'],null,['class'=>'form-control ','id'=>'findByActionId'])}}		
			</div>			
			{{-- username --}}
			<div class="col-sm-2">
				{{trans('admin.username')}}					
				{{Form::select('findByUsername',[],null,['class'=>'form-control ','id'=>'findByUsernameId'])}}		
			</div>
			<div class="col-md-2">		
				<br>			
				<!-- search -->
				<a href='#' onclick="searchFilter();" class="btn btn-white btn-primary btn-bold"><i class='fa fa-search bigger-110 blue'></i> {{trans('admin.search')}}</a>	
			</div>			
		</div>       
	</div>	  
	<br>          
	<div class="row">
		<div class="col-sm-12">					
                {{Form::open(['url'=>'admin/hr/attendance/holiday/destroy','method'=>'POST','id'=>'formData'])}}					
                <table id="dynamic-table" class="table table-bordered data-table" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="65px" class="center">#</th>  
                            <th class="center">{{trans('admin.history')}}</th>                                                                             
                            <th width="250px" class="center">{{trans('admin.updatedAt')}}</th>                                                                                                                              
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>	
                {{Form::close()}}
            
		</div><!-- /.col -->	
    </div> 
@endsection      
@section('javascript')
    <script>
        function searchFilter()
        {
            var department = $('#findByDepartmentId').val();
            var crud = $('#findByActionId').val();
            var username = $('#findByUsernameId').val();
            $('#dynamic-table').DataTable().destroy();
            var myTable = $('#dynamic-table').DataTable({    
                    processing: true,
                    serverSide: false,
					ajax:{
                        type:'POST',
                        url:'{{route("eventLogFilter")}}',
                        data: {
                            _method: 'PUT',
                            department : department,
                            username : username,
                            crud : crud,
                            _token:     '{{ csrf_token() }}'
                        }
                    }, 	                           
                    columns: [						
						{data: 'DT_RowIndex',     name: 'DT_RowIndex', orderable: false, searchable: false},		            							
						{data: 'history', 	      name: 'history', orderable: false, searchable: true},						
                        {data: 'updated_at',   	  name: 'updated_at', orderable: false, searchable: false}                   				
                    ],                    
                    @include('layouts.datatable.language')                       
                });   
                @include('layouts.datatable.code')
        }
        
		(function getAdmins()
	    {
	        $.ajax({
	          type:'ajax',
	          method:'get',
	          url:'{{route("getAdmins")}}',
	          dataType:'json',
	          success:function(data){
	            $('#findByUsernameId').html(data);	            
	          }
	        });        
	    }());	
    </script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
