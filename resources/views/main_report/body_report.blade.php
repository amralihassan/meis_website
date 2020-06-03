@include('layouts.header')
<body">
<div class="main-container ace-save-state" id="main-container"> 
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
@include('layouts.footer')