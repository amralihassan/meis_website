@include('layouts.header')
<body class="{{authInfo()->skin}}">
<div class="se-pre-con"></div>
    {{--  ==============================  navbar  ================================================= --}}
       
        @yield('navbar')

    {{--  ==============================  end navbar  ================================================= --}}
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>
    {{--  ==============================  sidebar  ================================================= --}}
       
        @yield('sidebar')
    {{--  ==============================  end side bar  ================================================= --}}
    @yield('page')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">                                   
                {{--  ==============================  Content  ======================================================== --}}
                @yield('content')
                {{--  ==============================  end Content  ==================================================== --}}

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
{{-- footer --}}
@include('layouts.sub_footer')
@include('layouts.footer')