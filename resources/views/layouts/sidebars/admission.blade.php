<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger" onclick='window.open("{{url('admission/settings')}}", "_blank")'>
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <!-- online register -->
        <li class="{{request()->segment(1) == 'admission'?'active':''}}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-globe"></i>
                <span class="menu-text">
                    {{trans('admission::admission.onlineRegister')}}
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu" style="display: {{request()->segment(1) == 'admission'?'block':'none'}};">
                <!-- index -->
                <li class="{{request()->segment(3) == 'online_register'?'active':''}}">
                    <a href="{{url('admission/all/online_register')}}">
                        <i class="menu-icon fa fa-caret-right"></i>{{trans('admission::admission.admissions')}}</a>
                    <b class="arrow"></b>
                </li>
                <!-- application code -->
                <li class="{{ request()->segment(3) == 'application_codes'?'active':''}}">
                    <a href="{{url('admission/online_register/application_codes')}}">
                        <i class="menu-icon fa fa-caret-right"></i>{{trans('admission::admission.applicationCodes')}}</a>
                    <b class="arrow"></b>
                </li>
                {{-- follow application process --}}
                <li class="{{ request()->segment(3) == 'follow_process'?'active':''}}">
                    <a href="{{url('admission/online_register/follow_process')}}">
                        <i class="menu-icon fa fa-caret-right"></i>{{trans('admission::admission.followApplicationProcess')}}</a>
                    <b class="arrow"></b>
                </li>
                {{-- update application process --}}
                <li class="{{ request()->segment(3) == 'process_page'?'active':''}}">
                    <a href="{{url('admission/online_register/process_page')}}">
                        <i class="menu-icon fa fa-caret-right"></i>{{trans('admission::admission.updateApplicationProcess')}}</a>
                    <b class="arrow"></b>
                </li>
                {{-- calendar for parent interview --}}
                <li class="{{ request()->segment(3) == 'parent_interview_calender'?'active':''}}">
                    <a href="{{url('admission/online_register/parent_interview_calender')}}">
                        <i class="menu-icon fa fa-caret-right"></i>{{trans('admission::admission.parentInterviewCalender')}}</a>
                    <b class="arrow"></b>
                </li>
                {{-- calendar for assessment test --}}
                <li class="{{ request()->segment(3) == 'assessment_test_calender'?'active':''}}">
                    <a href="{{url('admission/online_register/assessment_test_calender')}}">
                        <i class="menu-icon fa fa-caret-right"></i>{{trans('admission::admission.assessmentTestCalender')}}</a>
                    <b class="arrow"></b>
                </li>
                {{-- calendar for reassessment test --}}
                <li class="{{ request()->segment(3) == 'reassessment_test_calender'?'active':''}}">
                    <a href="{{url('admission/online_register/reassessment_test_calender')}}">
                        <i class="menu-icon fa fa-caret-right"></i>{{trans('admission::admission.reAssessmentTestCalender')}}</a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>



    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
