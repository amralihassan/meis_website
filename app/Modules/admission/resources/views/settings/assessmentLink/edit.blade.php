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
                <li>
                    <a href="{{url('admission/setting/assessment_links')}}">{{trans('admission::admission.assessmentLinksSetting')}}</a>
                </li>
                <li class="active">{{ !empty($title)?$title:trans('admin.employeesGate')}}</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <h1>
            {{$title}}
        </h1>
    </div><!-- /.page-header -->

    {{Form::open(['url'=>'admission/setting/assessment_links/update/'.$link->id,'class'=>'form-horizontal','role'=>'from' ,'method'=> 'post'])}}
    <div class="row">
        <div class="col-sm-12">
            <!-- testName -->
            <div class="form-group">
                {{Form::label('testName', trans('admission::admission.testName'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                <div class="col-sm-10">
                    {{Form::text('testName',$link->testName, ['class'=>'col-xs-10 col-sm-4','required'=>'required'])}}
                </div>
            </div>
            <!-- testType -->
            <div class="form-group">
                {{Form::label('testType', trans('admission::admission.testType'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                <div class="col-sm-3">
                    {{Form::select('testType',[''=>'-- '.trans('admission::admission.testType').' --','assessment'=>trans('admission::admission.assessment'),'reassessment'=>trans('admission::admission.reassessment')],$link->testType,['class'=>'form-control'])}}
                </div>
            </div>
            <!-- linkAddress -->
            <div class="form-group">
                {{Form::label('linkAddress', trans('admission::admission.linkAddress'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                <div class="col-sm-10">
                    {{Form::text('linkAddress',$link->linkAddress, ['class'=>'col-xs-10 col-sm-9','required'=>'required'])}}
                </div>
            </div>
            <!-- grade name -->
            <div class="form-group">
                {{Form::label('gradeId', trans('admission::admission.gradeName'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                <div class="col-sm-3">
                    {{Form::select('gradeId',[],$link->gradeId?'selected':'',['class'=>'form-control','id'=>'grade'])}}
                </div>
            </div>
            <!-- divisionsId -->
            <div class="form-group">
                {{Form::label('divisionsId', trans('admission::admission.divisionsId'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                <div class="col-sm-3">
                    <select name="divisionsId[]" class="form-control select2" multiple>
                        @foreach($divisions as $div)
                                <option {{ (in_array($div->id,explode(',',$link->divisionsId)))?'selected':'' }} value="{{$div->id}}">{{session('lang')=="ar"?$div->arDevision:$div-enDivision}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- status -->
            <div class="form-group">
                {{Form::label('status', trans('admission::admission.status'), ['class' => 'col-sm-2 control-label no-padding-right' ])}}
                <div class="col-sm-3">
                    {{Form::select('status',['In Active'=>trans('admission::admission.inActive'),'Active'=>trans('admission::admission.active')],$link->status,['class'=>'form-control'])}}
                </div>
            </div>
            <!-- notes -->
            <div class="form-group">
                {{Form::label('notes', trans('admission::admission.notes'), ['class' => 'col-sm-2 control-label no-padding-right'])}}
                <div class="col-sm-10">
                    {!! Form::textarea('notes',$link->notes,['class'=>'col-xs-10 col-sm-9','rows'=>'3']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- save -->
    <div class="clearfix form-actions">
        <div class="col-md-offset-2 col-md-10">
            {{Form::button('<i class="ace-icon fa fa-check bigger-110"></i> '.trans("admin.saveChanges"),['type' => 'submit','class'=>'btn btn-success'])}}
            {{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default','onclick'=>'location.href="'.url("admission/setting/assessment_links").'"'])}}
        </div>
    </div>
    {{Form::close()}}
@endsection
@section('javascript')
    <script>
        (function getGradeSelected()
        {
            var gradeId = "{{$link->gradeId}}";
            $.ajax({
                type:'POST',
                url:'{{route("getGrades.selected")}}',
                data: {
                    _method		: 'PUT',
                    gradeId 	: gradeId,
                    _token		: '{{ csrf_token() }}'
                },
                dataType:'json',
                success:function(data){
                    $('#grade').html(data);
                }
            });
        }());

    </script>
@endsection
@section('jquery')
    <script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
