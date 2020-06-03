@extends('layouts.app')
@section('content')			
	<div class="page-header">
		<h1>
			{{$title}}
		</h1>
	</div><!-- /.page-header -->	
	<div class="row">
		<div class="alert alert-block alert-danger">
			<p>
				<strong>
					<i class="ace-icon fa fa-ban"></i>
					{{$title}}!
				</strong>
				{{trans('admin.accessDeniedMessage')}}
			</p>

			<p>
				<button class="btn btn-sm btn-danger" onclick="location.href='{{aurl()}}'">{{trans('admin.back')}}</button>
			</p>
		</div>
	</div><!-- /.row -->

@endsection