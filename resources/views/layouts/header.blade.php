<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>{{ !empty($title)?$title:trans('admin.siteNameBrowser')}}</title>
 		<!-- icon -->
  		<link rel="shortcut icon" href="{{asset('images/website/'.settingHelper()->icon)}}">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{url('/public/design/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{url('/public/design/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
        <!-- ace styles -->

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
        @yield('styles')
        {{-- sweet alert style --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
		<link rel="stylesheet" href="{{url('/public/design/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="{{url('/public/design/css/bootstrap-multiselect.min.css')}}" />
        <link rel="stylesheet" href="{{url('/public/design/css/select2.min.css')}}" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="{{url('/public/design/css/jquery-ui.custom.min.css')}}" />
        <link rel="stylesheet" href="{{url('/public/design/css/jquery.gritter.min.css')}}" />

		<link rel="stylesheet" href="{{url('/public/design/css/ace-skins.min.css')}}" />

        <link rel="stylesheet" href="{{url('/public/design/css/main.css')}}" />
        @if (session('lang') == 'ar')
            <link rel="stylesheet" href="{{url('/public/design/css/ace-rtl.min.css')}}" />
            <link rel="stylesheet" href="{{url('/public/design/css/rtl.css')}}" />

        @endif
		<!-- ace settings handler -->
		<script src="{{url('/public/design/js/ace-extra.min.js')}}"></script>

		{{-- image loading --}}
        <style type="text/css">
            /* Paste this css to your style sheet file or under head tag */
            /* This only works with JavaScript,
            if it's not present, don't show loader */
            /*.no-js #loader { display: none;  }*/
            /*.js #loader { display: block; position: absolute; left: 100px; top: 0; }*/
            .se-pre-con {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url("{{url('public/design/loader-64x/mv2.gif')}}") center no-repeat #fff;        }
                .message{
                position: absolute;width: 100%;height: 50px;background-color: #11c011;color: white;line-height: 50px;
                z-index: 1200;text-align: center;opacity: 1;top: -50px ;
            }
            .sweet-alert h2 {font-family: 'Noto Kufi Arabic';font-weight: 500;}
            .sweet-alert p {font-family: 'Noto Kufi Arabic';}
            .sweet-alert button {font-family: 'Noto Kufi Arabic';}
            .sweet-alert {font-family: 'Noto Kufi Arabic';}

        </style>
	</head>
