
    </div><!-- /.main-container -->
        {{-- <script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script> --}}
        @yield('jquery')
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='{{url('/public/design/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
        </script>
        <script src="{{url('/public/design/js/bootstrap.min.js')}}"></script>
        <script src="{{url('/public/design/js/select2.min.js')}}"></script>

        <script src="{{url('/public/design/js/jquery-ui.custom.min.js')}}"></script>
        <script src="{{url('/public/design/js/jquery.ui.touch-punch.min.js')}}"></script>
        <script src="{{url('/public/design/js/bootbox.js')}}"></script>
        <script src="{{url('/public/design/js/jquery.easypiechart.min.js')}}"></script>
        <script src="{{url('/public/design/js/jquery.gritter.min.js')}}"></script>

        <!-- ace scripts -->
        <script src="{{url('/public/design/js/ace-elements.min.js')}}"></script>
        <script src="{{url('/public/design/js/ace.js')}}"></script>
        {{-- chnage page diraction --}}
        @if(dirPage() == 'rtl')
        <script>
            cAmr();
        </script>
        @endif
        @yield('timepicker')
        <script type="text/javascript">
            jQuery(function($){
                //select2
                $('.select2').css('width','200px').select2({allowClear:true})
                $('#select2-multiple-style .btn').on('click', function(e){
                    var target = $(this).find('input[type=radio]');
                    var which = parseInt(target.val());
                    if(which == 2) $('.select2').addClass('tag-input-style');
                        else $('.select2').removeClass('tag-input-style');
                });
            });
            // remove image loading
            $(".se-pre-con").fadeOut("slow");
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()
                })
        </script>
        {{-- sweet alert --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        {{-- message alerts --}}
        @include('sweet::alert')
        {{-- datatable scripts --}}
        @include('layouts.datatable.dataTableScripts')

        {{-- come from view blades --}}
        @yield('javascript')
        {{-- auto load all user notification --}}
        <script>
            ;
            (function()
            {
                $.ajax({
                    type:'get',
                    url:'{{route("user.notifications")}}',
                    dataType:'json',
                    success:function(data){
                        $('#count').html(data.count);
                        $('#countTitle').html(data.countTitle);
                        $('#notifications').html(data.notifications);
                        $('#view').html(data.view);
                    }
                });
            }());
            setInterval(function()
            {
                $.ajax({
                    type:'get',
                    url:'{{route("user.notifications")}}',
                    dataType:'json',
                    success:function(data){
                        $('#count').html(data.count);
                        $('#countTitle').html(data.countTitle);
                        $('#notifications').html(data.notifications);
                        $('#view').html(data.view);
                    }
                });
            },50000); //5000

        </script>
    </body>
</html>
